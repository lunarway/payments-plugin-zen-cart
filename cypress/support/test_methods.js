/// <reference types="cypress" />

'use strict';

import { PluginTestHelper } from './test_helper.js';

export var TestMethods = {

    /** Admin & frontend user credentials. */
    StoreUrl: (Cypress.env('ENV_ADMIN_URL').match(/^(?:http(?:s?):\/\/)?(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)/im))[0],
    AdminUrl: Cypress.env('ENV_ADMIN_URL'),
    RemoteVersionLogUrl: Cypress.env('REMOTE_LOG_URL'),

    /** Construct some variables to be used bellow. */
    ShopName: 'zencart',
    VendorName: 'lunar',
    PaymentMethodsAdminUrl: '/index.php?cmd=modules&set=payment',
    OrdersPageAdminUrl: '/index.php?cmd=orders',

    /**
     * Login to admin backend account
     */
    loginIntoAdminBackend() {
        cy.loginIntoAccount('input[name=admin_name]', 'input[name=admin_pass]', 'admin');
    },
    /**
     * Login to client|user frontend account
     */
    loginIntoClientAccount() {
        cy.get('a[href*=login]').first().click();
        cy.loginIntoAccount('#login-email-address', '#login-password', 'client');
    },

    /**
     * Modify plugin settings
     * @param {String} captureMode
     */
    changeCaptureMode(captureMode) {
        /** Go to payment method. */
        cy.goToPage(this.PaymentMethodsAdminUrl);

        /** Select payment method. */
        cy.get('.dataTableContent').contains(this.VendorName).click();

        cy.get('#editButton').click();

        /** Select capture mode. */
        cy.get(`input[value=${captureMode}]`).click()

        cy.get('#saveButton').click();
    },

    /**
     * Make payment with specified currency and process order
     *
     * @param {String} currency
     * @param {String} paymentAction
     * @param {Boolean} partialAmount
     */
     payWithSelectedCurrency(currency, paymentAction, partialAmount = false) {
        /** Make an instant payment. */
        it(`makes a payment with "${currency}"`, () => {
            this.makePaymentFromFrontend(currency);
        });

        /** Process last order from admin panel. */
        it(`process (${paymentAction}) an order from admin panel`, () => {
            this.processOrderFromAdmin(paymentAction, partialAmount);
        });
    },

    /**
     * Make an instant payment
     * @param {String} currency
     */
    makePaymentFromFrontend(currency) {
        /** Go to store frontend. */
        cy.goToPage(this.StoreUrl);

        /** Change currency. */
        this.changeShopCurrency(currency);

        cy.wait(500);

        /**
         * Select specific product.
         */
        var randomInt = PluginTestHelper.getRandomInt(/*max*/ 1);
        if (0 === randomInt) {
            cy.goToPage(this.StoreUrl + '/index.php?main_page=product_info&cPath=53&products_id=115');
        } else {
            cy.goToPage(this.StoreUrl + '/index.php?main_page=product_info&cPath=23&products_id=49');
        }

        cy.get('.button_in_cart').click();

        /** Go to checkout. */
        cy.get('.button_checkout').click();

        /** Continue checkout. */
        cy.get('.button_continue_checkout').click();

        /** Choose payment method. */
        cy.get(`input[id*=${this.VendorName}]`).click();

        /** Continue checkout. */
        cy.get('#paymentSubmit').click();

        /** Get total amount. */
        cy.get('#ottotal .totalBox').then($grandTotal => {
            var expectedAmount = PluginTestHelper.filterAndGetAmountInMinor($grandTotal, currency);
            cy.wrap(expectedAmount).as('expectedAmount');
        });

        /** Show payment popup. */
        cy.get('#btn_submit').click();

        /** Get payment amount. */
        cy.get('.overlay.transaction .payment .amount').then($popupAmount => {
            var orderTotalAmount = PluginTestHelper.filterAndGetAmountInMinor($popupAmount, currency);
            cy.get('@expectedAmount').then(expectedAmount => {
                expect(expectedAmount).to.eq(orderTotalAmount);
            });
        });

        /**
         * Fill in payment popup.
         */
         PluginTestHelper.fillAndSubmitPopup();

        cy.wait(500);

        cy.get('h1#checkoutSuccessHeading').should('be.visible');
    },

    /**
     * Process last order from admin panel
     * @param {String} paymentAction
     * @param {Boolean} partialAmount
     */
    processOrderFromAdmin(paymentAction, partialAmount = false) {
        /** Go to admin orders page. */
        cy.goToPage(this.OrdersPageAdminUrl);

        /** Click on first (latest in time) order from orders table. */
        cy.get('#defaultSelected').click();

        /**
         * Take specific action on order
         */
        this.paymentActionOnOrderAmount(paymentAction, partialAmount);
    },

    /**
     * Capture an order amount
     * @param {String} paymentAction
     * @param {Boolean} partialAmount
     */
     paymentActionOnOrderAmount(paymentAction, partialAmount = false) {
        /** Show payment info. */
        cy.get('#payinfo').click();

        switch (paymentAction) {
            case 'capture':
                cy.get('#capture_click').click();
                break;
            case 'refund':
                cy.get('#refund_click').click();
                if (partialAmount) {
                    /**
                     * Put 8 major units to be refunded.
                     * Premise: any product must have price >= 8.
                     */
                    cy.get('input[name=refamt]').clear().type(8);
                    cy.get('input[name=partialrefund]').click();
                } else {
                    cy.get('input[name=fullrefund]').click();
                }
                break;
            case 'void':
                cy.get('#void_click').click();
                break;
        }

        /** Check if success message. */
        cy.get('.alert-success').should('be.visible');
    },

    /**
     * Change shop currency in frontend
     */
    changeShopCurrency(currency) {
        cy.get('#select-currency').select(currency);
    },

    /**
     * Get Shop & plugin versions and send log data.
     */
    logVersions() {
        /** Get framework version. */
        cy.get('.adminHeaderAlerts').contains('using').then($frameworkVersion => {
            // var frameworkVersion = (($frameworkVersion.text()).replace(/[^0-9.]/g, '')).substring;
            var frameworkVersion = ($frameworkVersion.text()).replace(/\.?[^0-9.]/g, '');
            cy.wrap(frameworkVersion).as('frameworkVersion');
        });

        /** Get plugin version with request from a file. */
        cy.request({
            url: this.StoreUrl + '/includes/modules/payment/lunar_version.txt',
            auth: {
                username: Cypress.env('ENV_HTTP_USER'),
                password: Cypress.env('ENV_HTTP_PASS')
            }}).then((resp) => {
            cy.wrap(resp.body).as('pluginVersion');
        });

        /** Get global variables and make log data request to remote url. */
        cy.get('@frameworkVersion').then(frameworkVersion => {
            cy.get('@pluginVersion').then(pluginVersion => {

                cy.request('GET', this.RemoteVersionLogUrl, {
                    key: frameworkVersion,
                    tag: this.ShopName,
                    view: 'html',
                    ecommerce: frameworkVersion,
                    plugin: pluginVersion
                }).then((resp) => {
                    expect(resp.status).to.eq(200);
                });
            });
        });
    },
}