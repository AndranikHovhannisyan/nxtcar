'use strict';

define([],function(){
    return angular.module("Geolocation",[])
        .constant('currency',{
            'GBP': '&#163;',
            'EUR': '&#128;',
            'PLN': 'z&#322;',
            'RUB': 'p.',
            'UAH': '&#8372;',
            'TRY': 'TL'
        })
        .constant('countries',{
            'gb': {
                'currency': '&#163;',
                'money': 'GBP',
                'name': 'English',
                'icon': '/bundles/nxtcarmain/images/flags/png/gb.png'
            },
            'de': {
                'currency': '&#128;',
                'money': 'EUR',
                'name': 'Deutsch',
                'icon': '/bundles/nxtcarmain/images/flags/png/de.png'
            },
            'es': {
                'currency': '&#128;',
                'money': 'EUR',
                'name': 'Español',
                'icon': '/bundles/nxtcarmain/images/flags/png/es.png'
            },
            'fr': {
                'currency': '&#128;',
                'money': 'EUR',
                'name': 'Français',
                'icon': '/bundles/nxtcarmain/images/flags/png/fr.png'
            },
            'it': {
                'currency': '&#128;',
                'money': 'EUR',
                'name': 'Italiano',
                'icon': '/bundles/nxtcarmain/images/flags/png/it.png'
            },
            'nd': {
                'currency': '&#128;',
                'money': 'EUR',
                'name': 'Nederlands',
                'icon': '/bundles/nxtcarmain/images/flags/png/nl.png'
            },
            'pl': {
                'currency': 'z&#322;',
                'money': 'PLN',
                'name': 'Polski',
                'icon': '/bundles/nxtcarmain/images/flags/png/pl.png'
            },
            'pr': {
                'currency': '&#128;',
                'money': 'EUR',
                'name': 'Português',
                'icon': '/bundles/nxtcarmain/images/flags/png/pt.png'
            },
            'ru': {
                'currency': 'p.',
                'money': 'RUB',
                'name': 'Русский',
                'icon': '/bundles/nxtcarmain/images/flags/png/ru.png'
            },
            'uk': {
                'currency': '&#8372;',
                'money': 'UAH',
                'name': 'Українська',
                'icon': '/bundles/nxtcarmain/images/flags/png/ua.png'
            },
            'tr': {
                'currency': 'TL',
                'money': 'TRY',
                'name': 'Türkçe',
                'icon': '/bundles/nxtcarmain/images/flags/png/tr.png'
            }
        });
})