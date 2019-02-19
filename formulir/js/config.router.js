angular.module('app').run(
        ['$rootScope', '$state', '$stateParams', 'Data',
            function ($rootScope, $state, $stateParams, Data) {
                $rootScope.$state = $state;
                $rootScope.$stateParams = $stateParams;
                //pengecekan login
                $rootScope.$on("$stateChangeStart", function (event, toState) {
//                    Data.get('site/sessionPeserta').then(function (results) {
//                        if (typeof results.data.peserta != "undefined") {
//                            $rootScope.user = results.data.peserta;
//                        } else {
//                            $state.go("access.signin");
//                        }
//                    });
                });
            }
        ]).config(
        ['$stateProvider', '$urlRouterProvider', '$locationProvider',
            function ($stateProvider, $urlRouterProvider, $locationProvider) {

                //$locationProvider.html5Mode(true)

                $urlRouterProvider.otherwise('/site/404');
                $stateProvider.state('site', {
                    abstract: true,
                    templateUrl: 'tpl/app.html'
                }).state('site.index', {
                    url: '/:sekolah_id/:alias',
                    templateUrl: 'tpl/index.html',
                    controller: function ($stateParams) {
                        $stateParams.sekolah_id //*** Exists! ***//
                    },
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['angularFileUpload'])
                                        .then(
                                                function () {
                                                    return $ocLazyLoad.load('tpl/site/site.js');
                                                }
                                        );
                            }]
                    }
                }).state('site.404', {
                    url: '/404',
                    templateUrl: 'tpl/page_404.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('tpl/site/dashboard.js');
                            }
                        ]
                    }
                }).state('site.pencarian', {
                    url: '/pencarian',
                    templateUrl: 'tpl/pencarian/pencarian.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('tpl/pencarian/pencarian.js');
                            }
                        ]
                    }
                }).state('site.hasil', {
                    url: '/hasil',
                    templateUrl: 'tpl/hasil/hasil.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('tpl/hasil/hasil.js');
                            }
                        ]
                    }
                }).state('site.pendaftar', {
                    url: '/pendaftar',
                    templateUrl: 'tpl/pendaftar/pendaftar.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('tpl/pendaftar/pendaftar.js');
                            }
                        ]
                    }
                }).state('site.detail', {
                    url: '/:id',
                    templateUrl: 'tpl/detail/detail.html',
                    controller: function ($stateParams) {
                        $stateParams.id //*** Exists! ***//
                    },
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('tpl/detail/detail.js');
                            }
                        ]
                    }
                })
                        // others
                        .state('access', {
                            url: '/access',
                            template: '<div ui-view class="fade-in-right-big smooth"></div>'
                        }).state('access.signin', {
                    url: '/signin',
                    templateUrl: 'tpl/page_signin.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('tpl/site/site.js').then();
                            }
                        ]
                    }
                }).state('access.404', {
                    url: '/404',
                    templateUrl: 'tpl/page_404.html'
                }).state('access.forbidden', {
                    url: '/forbidden',
                    templateUrl: 'tpl/page_forbidden.html'
                })

            }
        ]);
