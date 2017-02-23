wordpressApp.service('wordpressService', ['$resource','$location','$sce','$timeout','spinnerService',function($resource, $location, $sce, $timeout, spinnerService){
  var that = this;

  //Do some of the wordpress API formatting stuff that might be repeating in the different controllers.
  that.escapeIt = function(string){
    var trustedHtml = $sce.trustAsHtml(string);
    return trustedHtml;
  }

  that.getResource = function(sourceDirectory,type,uniqueId,filter,callback){
    //handles single or all categories query
    var type = type || 'posts',
    uniqueId = '/' + uniqueId || '/',
    queryString = sourceDirectory + '/wp-json/wp/v2/' + type + uniqueId;
    var query = $resource(queryString);
    if(type === 'posts'){
      var results = query.get({},function(){
        $scope.hiding = true;
        $log.info($scope.hiding);
        $timeout(function(){spinnerService.hide('impatientWaiting');},2000);
      });
    } else {
      var results = query.query({},function(){
        $timeout(function(){spinnerService.hide('impatientWaiting');},2000);
      });
    }
    return results;
  }

  that.loaderShow = function(selector, animationType, speed){
    var animationType = animationType || 'fade',
    speed = speed || 500;

    if (animationType === 'fade'){
      angular.element(selector).fadeIn(speed);
    }
  };

  that.loaderHide = function(selector, waitTime, animationType, speed){
    var waitTime = waitTime || 2000,
    animationType = animationType || 'fade',
    speed = speed || 'slow';

    setTimeout(function(){
      if (animationType === 'fade'){
        angular.element(selector).fadeOut(speed);
      }
    }, waitTime);
  };
}]);
