wordpressApp.service('wordpressService', ['$resource','$location','$sce',function($resource, $location, $sce){
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
    console.log(queryString);
    var query = $resource(queryString);
    if(type === 'posts'){
      var results = query.get();
    } else {
      var results = query.query();      
    }
    return results;
  }

  that.loaderShow = function(selector, animationType, speed){
    var animationType = animationType || 'fade',
    speed = speed || 'fast';

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
