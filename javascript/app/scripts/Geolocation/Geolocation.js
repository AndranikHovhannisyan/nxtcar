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
            'en': {
                'money': '&#163;',
                'name': 'English',
                'icon': '/bundles/nxtcarmain/images/flags/png/england.png'
            },
            'de': {
                'money': '&#128;',
                'name': 'Deutsch',
                'icon': '/bundles/nxtcarmain/images/flags/png/de.png'
            },
            'es': {
                'money': '&#128;',
                'name': 'Español',
                'icon': '/bundles/nxtcarmain/images/flags/png/es.png'
            },
            'fr': {
                'money': '&#128;',
                'name': 'Français',
                'icon': '/bundles/nxtcarmain/images/flags/png/fr.png'
            },
            'it': {
                'money': '&#128;',
                'name': 'Italiano',
                'icon': '/bundles/nxtcarmain/images/flags/png/it.png'
            },
            'nd': {
                'money': '&#128;',
                'name': 'Nederlands',
                'icon': '/bundles/nxtcarmain/images/flags/png/nl.png'
            },
            'pl': {
                'money': 'z&#322;',
                'name': 'Polski',
                'icon': '/bundles/nxtcarmain/images/flags/png/pl.png'
            },
            'pr': {
                'money': '&#128;',
                'name': 'Português',
                'icon': '/bundles/nxtcarmain/images/flags/png/pt.png'
            },
            'ru': {
                'money': 'p.',
                'name': 'Русский',
                'icon': '/bundles/nxtcarmain/images/flags/png/ru.png'
            },
            'uk': {
                'money': '&#8372;',
                'name': 'Українська',
                'icon': '/bundles/nxtcarmain/images/flags/png/ua.png'
            },
            'tr': {
                'money': 'TL',
                'name': 'Türkçe',
                'icon': '/bundles/nxtcarmain/images/flags/png/tr.png'
            }
        });
})