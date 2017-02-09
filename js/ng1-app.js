// MODULE
var wordpressApp = angular.module('wordpressApp', ['ngMessages','ngResource','ngSanitize','ngRoute']);

// CONTROLLERS
wordpressApp.controller('mainController', ['$scope', '$log', '$filter', '$resource', '$timeout', '$sce', '$location', 'scramblrService', 'wordpressService', function ($scope,$log,$filter,$resource,$timeout,$sce,$location,scramblrService,wordpressService) {
  scramblrService.log = $log; //Pass log over to the service.
  //Mmmmmm Scrambled Strings
  $scope.scrambleOptions = ['complex (coming soon)','unicode bubble sorted', 'unicode merge sorted', 'basic'];
  $scope.scrambleType = 'basic';

  $scope.toScrambleString = scramblrService.toScrambleString;

  $scope.$watch('toScrambleString',function(){
    scramblrService.toScrambleString = $scope.toScrambleString;
  });

  $scope.scrambleIt = function(){
    $scope.scrambledString = scramblrService.scrambleIt($scope.scrambleType);
  };
// START OF BLOG CONTROLLER
  $scope.blogPostsQuery = $resource('http://juddfranklin-blog/index.php/wp-json/wp/v2/posts');

  $scope.blogPosts = $scope.blogPostsQuery.query(function(){
    for(var i = 0; i < $scope.blogPosts.length; i++){
      $scope.blogPosts[i].excerpt.rendered = $scope.blogPosts[i].excerpt.rendered + '<a href="#/single/' + $scope.blogPosts[i].id + '">read more</a>';
      var postDate = new Date($scope.blogPosts[i].date);

      $scope.blogPosts[i].dateFormatted = postDate.toDateString();
    };
  });
  $scope.categories = wordpressService.getCategories('http://juddfranklin-blog/index.php');

}]);
wordpressApp.controller('singleBlogPostController', ['$scope', '$log', '$filter', '$resource', '$timeout', '$sce', '$location', '$routeParams', 'wordpressService', function ($scope,$log,$filter,$resource,$timeout,$sce,$location,$routeParams,wordpressService) {
  // START OF SINGLE POST CONTROLLER
  $scope.blogPostId = $routeParams.blogPostId || null;

  if ($scope.blogPostId != null) {
    $scope.singleBlogPostQuery = $resource('http://juddfranklin-blog/index.php/wp-json/wp/v2/posts/' + $scope.blogPostId);

    $scope.blogPost = $scope.singleBlogPostQuery.get(function(){
      $scope.blogPost.content.rendered = wordpressService.escapeIt($scope.blogPost.content.rendered);
      $log.info($scope.blogPost.content.rendered);
    });
  } else {
    $scope.blogPost = {};
    $scope.blogPost.title = {};
    $scope.blogPost.title.rendered = "Don't forget to look for a specific post!";
    $scope.blogPost.content = {};
    $scope.blogPost.content.rendered = "You didn't pick a post to go to, please <a href='/index.php/angularjs/#/'>try again</a>.";
  }

  $scope.categories = wordpressService.getCategories('http://juddfranklin-blog/index.php');
}]);
wordpressApp.controller('categoryController', ['$scope', '$log', '$filter', '$resource', '$timeout', '$sce', '$location', '$routeParams', 'wordpressService', function ($scope,$log,$filter,$resource,$timeout,$sce,$location,$routeParams,wordpressService) {
  $scope.catId = $routeParams.catId || null;

  $scope.singleCategoryQuery = $resource('http://juddfranklin-blog/index.php/wp-json/wp/v2/categories/' + $scope.catId);

  $scope.category = $scope.singleCategoryQuery.get();

  $scope.blogPostsQuery = $resource('http://juddfranklin-blog/index.php/wp-json/wp/v2/posts?filter[cat]=' + $scope.catId);

  $scope.blogPosts = $scope.blogPostsQuery.query(function(){
    for(var i = 0; i < $scope.blogPosts.length; i++){
      $scope.blogPosts[i].excerpt.rendered = $scope.blogPosts[i].excerpt.rendered + '<a href="#/single/' + $scope.blogPosts[i].id + '">read more</a>';
    };
  });

  $scope.categories = wordpressService.getCategories('http://juddfranklin-blog/index.php');
}]);

wordpressApp.directive("postDirective",function(){
  return {
    restrict: 'AECM',
    templateUrl: '/wp-content/themes/juddtheme/ng1/ng1-directives/excerpt-post.tpl.html',
    replace: true,
    scope: {
      postObject: '='
    }
  }
});
//NOTES
var dependencyInjection = {
  definition: "passing a formed object into a function",
  explanation: "initializing an object and passing it into a function allows the function to be agnostic about how the object is created or what is in it."
}

var toString = {
  defintion: "a method of a function object that converts the entire function as a string",
  explanation: "This can allow a system to use string anaylsis to analyze a function objectively, and to figure out details of it such as what its arguments are."
}
