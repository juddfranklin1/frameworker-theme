wordpressApp.service('wordpressService', ['$resource','$location','$sce',function($resource, $location, $sce){
  var that = this;

  //Do some of the wordpress API formatting stuff that might be repeating in the different controllers.
  that.escapeIt = function(string){
    var trustedHtml = $sce.trustAsHtml(string);
    return trustedHtml;
  }

  that.getResource = function(sourceDirectory,type,uniqueId){
    //handles single or all categories query
    var type = type || 'posts'
    var uniqueId = '/' || '/' + uniqueId;
    var query = $resource(sourceDirectory + '/wp-json/wp/v2/' + type + uniqueId);
    var results = query.query();
    console.log(results);
    return results;
  }
}]);
