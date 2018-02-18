// NOTE: datatables wasnt working because jqueryUI, was not being loaded in the proper order in config, 
// order does matter in the config require.config object 
// The base path is decided based on the directory that the main.js is in. Since this is loaded first. 
// Modules can only be referenced with folders, that are within the base path directory. 

// ADDED TO ALL FILES. 
require.config({
    baseUrl: '/js/',
    urlArgs: "bust=v1",
    paths: {
        // VENDORS
        'jquery': 'vendors/jquery-1.11.0', 
        'jqueryUi': 'vendors/jquery-ui.min',
        'bootstrap':'vendors/bootstrap/js/bootstrap.min',
        'owlCarousel' : "vendors/owl.carousel/owl.carousel.min",
        'mapster':'plugins/jquery.imagemapster',
        //'datatables': 'vendors/datatables.min', //OLD this MUST be called "datatables"  because the idiots in tableTools have the require('datatables'), directly in their plugin, UNBENOUNCED to everyone FUCKERS.
        'blockui':'vendors/jquery.blockui',
        'mustache': 'vendors/mustache',
        'chosen':'vendors/chosen.jquery',
        'jqueryValidate':'vendors/jquery.validate.min',
        'jgrowl':'vendors/jquery.jgrowl',
        'jCookie':'vendors/jquery.cookie',
        'hashtable':'vendors/jshashtable-3.0',
        'numberFormatter':'vendors/jquery.numberformatter-1.2.4.jsmin',
        'polygonCreator':'vendors/polygon', // allows for polygon creation on a google map. 
        'polygonMapExtension':'vendors/maps.google.polygon.containsLatLng', // extends google.map.Polygon to include a containsLatLng() function.
        'platformJs': 'vendors/platform',

        // Vendors NEW
        'select2' : '../node_modules/select2/dist/js/select2.min',

        // VENDORS - New Data Tables and extensions, only way to get buttons working. 
        // we have a working version as datatables.net, but we have 'datatables' in all of our examples. 
        'datatables.net' : 'vendors/datatables/jquery.dataTables',
        'datatables.net-buttons' : 'vendors/datatables/dataTables.buttons',
        'datatables.net-buttons-flash' : 'vendors/datatables/buttons.flash',
        'datatables.net-buttons-print' : 'vendors/datatables/buttons.print',
        'datatables.net-buttons-html5' : 'vendors/datatables/buttons.html5',
        'datatablesJsZip' : 'vendors/datatables/jszip.min', // this one might be necessary for the .csv stuff
        'datatablesPdfMake' : 'vendors/datatables/pdfmake.min',
        'datatablesVfsFonts' : 'vendors/datatables/vfs_fonts', // used with the pdf Make


        // Vendors charts
        'morris':'vendors/morris/morris.min', // morris charts
        'raphael':'vendors/morris/raphael.min', // morris charts
        'flot':'vendors/flot/jquery.flot',
        'flotToolTip':'vendors/flot/jquery.flot.tooltip.min',
        'flotResize':'vendors/flot/jquery.flot.resize',
        'flotPie':'vendors/flot/jquery.flot.pie',
        'morrisData':'vendors/morris/morrisData',
        'flotData':'vendors/flot/flotData',
        'FastMarkerOverlay': 'vendors/FastMarkerOverlay', // This is the redfin fast marker JS that allows for markers to be added to google map.

        // *** New modules ***
        // came with the template
        'front' : 'front', // this came as the base js with the template. change this later on.
        "cryptcompareGetallcoins": "modules/cryptocompare/getallcoins",
        "cryptcompareGetCoinPrice": "modules/cryptocompare/getCoinPrice",

        "numberUtilities" : "modules/numberUtilities",

        // **** pages ****
        // sometimes you may want to include an entire section or page somewhere else like a vm. so you can referance a page here.
        "appPredictionsSingleDay" : "predictions/app-predictions-single-day",

        //** New Vendors ***/
        'popper': "vendors/popper.min",
        'd3' : 'vendors/d3/d3.min', //  i dont think this is loading correctly right now. 
        'techan' : 'vendors/d3/techan', // This is a private library built on top of d3 for awesome stock charts, https://github.com/andredumas/techan.js

    },
      

    //  YOU STILL NEED TO INCLUDE SOME OF THE MAJOR ONES IN any of the define functions, such as EVENTS, if you are using them.
    // For some reason Jquery, does not need to be referenced individually, probably because it is in global scope.
    shim: {
       'jqueryUi': {
           'deps': ['jquery'], // depends on jquery
       },
       'bootstrap': {
           'deps': ['jquery', 'jqueryUi', 'popper'], // depends on jquery
       },
       'jgrowl': {
           'deps': ['jquery', 'jqueryUi', 'bootstrap'], // depends on jquery
       },
       'owlCarousel' : {
        'deps' : ['jquery']
       },
       'front' : {
        'deps' : ['owlCarousel', 'jquery']
       }
    },
});


require(["jquery", "jqueryUi", "bootstrap", "front", "owlCarousel", "select2", "blockui", ], function ($, jqueryUi, bootstrap, front, owlCarousel, select2, blockui) {
  $(document).ready(function(){
    require([ $('#requirePageSpecificJs').val() ]); // this is set in php, result: "/require-mturk.js" 
  });
});



/*// MODULES // OLD module paths from AT
'events':'modules/events',
'isOnScreen' : 'modules/isOnScreen', // used for homepage animation, things scrolling into view. 
'ajaxHandlers': 'modules/ajaxHandlers',
'ajaxObj': 'modules/ajaxHandlers-objects',
'displayTableExcalibur': 'modules/displayTableExcalibur', 
'template': 'modules/template', // template module to make functionality work.
'templateCommon': 'modules/template-common-fetch', // common templates can be fetched and handled here.
'printPreview': 'modules/printPreview',
'turkUpdateUi': 'modules/turkUpdateUi',
'turkHelpers': 'modules/turkHelpers',
'excaliburFixNames':'modules/excaliburFixNames',
'tableRowClick': 'modules/tableRowClick',
'adminHelpers': 'modules/x-admin-helpers',
'settings': 'modules/settings',
'universalEvents': 'modules/universalEvents', // used for universal click functions inside pages that exist in /at/
'charts': 'modules/charts',
'modals': 'modules/modals',
'helpers': 'modules/helpers',
'displayTableSavedListings': 'modules/displayTableSavedListings',
'gmaps': 'modules/google-maps',
'register': 'modules/register',
'searchHelper': 'modules/search-helper', // functionality that can be shared between list view and map view.
'prototypes': 'modules/prototypes', // prototype extensions or standalone plugins
'timer':'modules/timer',
'cookieHelper':'modules/cookieHelper',
'savedSearches': 'modules/saved-searches',
'zillowHelper': 'modules/zillowHelper',
'modalDetailFunctionality' : 'modules/modalDetailFunctionality',
'zipCodeCreator': 'modules/zipCodeCreator',
'messenger': 'modules/messenger',
'dateHelper': 'modules/dateHelper',
'mapHelper': 'modules/maps/map-helper',

// MODULES - homepage specific
'homepageSearch' : 'modules/homepage/homepageSearch',*/