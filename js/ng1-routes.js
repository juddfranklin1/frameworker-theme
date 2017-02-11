// ROUTES
wordpressApp.config(function ($routeProvider){
  $routeProvider
  .when('/',{
    templateUrl: '/wp-content/themes/frameworker-theme/ng1/ng1-layouts/list.html',
    controller: 'mainController'
  })
  .when('/single',{
    templateUrl: '/wp-content/themes/frameworker-theme/ng1/ng1-layouts/single.html',
    controller: 'singleBlogPostController'
  })
  .when('/single/:blogPostId',{
    templateUrl: '/wp-content/themes/frameworker-theme/ng1/ng1-layouts/single.html',
    controller: 'singleBlogPostController'
  })
  .when('/category',{
    templateUrl: '/wp-content/themes/frameworker-theme/ng1/ng1-layouts/list.html',
    controller: 'categoryController'
  })
  .when('/category/:catId',{
    templateUrl: '/wp-content/themes/frameworker-theme/ng1/ng1-layouts/list.html',
    controller: 'categoryController'
  });
});
