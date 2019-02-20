// lazyload config

angular.module('app')
        // oclazyload config
        .config(['$ocLazyLoadProvider', function ($ocLazyLoadProvider) {
                // We configure ocLazyLoad to use the lib script.js as the async loader
                $ocLazyLoadProvider.config({
                    debug: false,
                    events: true,
                    modules: [
                        {
                            name: 'daterangepicker',
                            files: [
                                'js/lib/daterangepicker/angular-daterangepicker.min.js',
                                'js/lib/daterangepicker/daterangepicker.min.js',
                                'js/lib/daterangepicker/daterangepicker.min.css',
                            ]
                        },
                        {
//                            name: 'FileManagerApp',
//                            files: [
//                                'js/lib/angular-filemanager.min.js',
//                                'css/angular-filemanager.min.css',
//                            ]
                        },
                        {
                            name: 'angularFileUpload',
                            files: [
                                'js/lib/angular-file-upload.min.js'
                            ]
                        },
                    ]
                });
            }])
        ;
