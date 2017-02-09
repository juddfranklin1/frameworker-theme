wordpressApp.service('wordpressService', function($resource, $sce){
  var that = this;

  //Do some of the wordpress API formatting stuff that might be repeating in the different controllers.
  that.escapeIt = function(string){
    var trustedHtml = $sce.trustAsHtml(string);
    return trustedHtml;
  }

  that.getCategories = function(sourceDirectory,currentCategory){
    var categories = $resource(sourceDirectory + '/wp-json/wp/v2/categories');
    var categoriesGotten = categories.query();
    for (category in categoriesGotten) {
    }
    return categoriesGotten;
  }

  that.getCategory = function(sourceDirectory,categoryIdentifier){
    var category = $resource(sourceDirectory + '/wp-json/wp/v2/categories/' + categoryIdentifier);
    var categoryGotten = category.query();
    return categoryGotten;
  }
});
