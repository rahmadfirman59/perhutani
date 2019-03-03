angular.module('app')
        .run(
                ['$rootScope', '$state', '$stateParams', 'Data',
                    function ($rootScope, $state, $stateParams, Data) {
                        $rootScope.$state = $state;
                        $rootScope.$stateParams = $stateParams;
                        //pengecekan login
                        $rootScope.$on("$stateChangeStart", function (event, toState) {
                            Data.get('site/session').then(function (results) {
                                if (typeof results.data.user != "undefined") {
                                    $rootScope.user = results.data.user;
                                } else {
                                    $state.go("access.signin");
                                }
                            });
                        });
                    }
                ]
                )
        .config(
                ['$stateProvider', '$urlRouterProvider',
                    function ($stateProvider, $urlRouterProvider) {

                        $urlRouterProvider
                                .otherwise('/site/dashboard');
                        $stateProvider
                                .state('site', {
                                    abstract: true,
                                    url: '/site',
                                    templateUrl: 'tpl/app.html'
                                })
                                .state('site.dashboard', {
                                    url: '/dashboard',
                                    templateUrl: 'tpl/dashboard.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {

                                            }]
                                    }
                                })

                                // others
                                .state('access', {
                                    url: '/access',
                                    template: '<div ui-view class="fade-in-right-big smooth"></div>'
                                })
                                .state('access.signin', {
                                    url: '/signin',
                                    templateUrl: 'tpl/page_signin.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('tpl/site/site.js').then(
                                                        );
                                            }]
                                    }
                                })
                                .state('access.404', {
                                    url: '/404',
                                    templateUrl: 'tpl/page_404.html'
                                })
                                .state('access.forbidden', {
                                    url: '/forbidden',
                                    templateUrl: 'tpl/page_forbidden.html'
                                })
                                //master
                                .state('master', {
                                    url: '/master',
                                    templateUrl: 'tpl/app.html'
                                })
                                .state('master.filemanager', {
                                    url: '/filemanager',
                                    templateUrl: 'tpl/m_filemanager/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load([''])
                                                        .then(
                                                                function () {
                                                                    return $ocLazyLoad.load('tpl/m_filemanager/filemanager.js');
                                                                }
                                                        );
                                            }]
                                    }
                                })
                                .state('master.userprofile', {
                                    url: '/profile',
                                    templateUrl: 'tpl/m_user/profile.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('tpl/m_user/pengguna_profile.js');
                                            }]
                                    }
                                })
                                .state('master.artikel', {
                                    url: '/article',
                                    templateUrl: 'tpl/m_artikel/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('tpl/m_artikel/index.js');
                                            }]
                                    }
                                })
                                .state('master.pendaki', {
                                    url: '/pendaki',
                                    templateUrl: 'tpl/m_pendaki/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('tpl/m_pendaki/index.js');
                                            }]
                                    }
                                })
                                .state('master.roles', {
                                    url: '/roles',
                                    templateUrl: 'tpl/m_roles/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('tpl/m_roles/roles.js');
                                            }]
                                    }
                                })
                                .state('master.setting', {
                                    url: '/setting',
                                    templateUrl: 'tpl/m_setting/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('tpl/m_setting/index.js');
                                            }]
                                    }
                                })
                                .state('master.user', {
                                    url: '/user',
                                    templateUrl: 'tpl/m_user/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('tpl/m_user/pengguna.js');
                                            }]
                                    }
                                });
                    }
                ]
                );
