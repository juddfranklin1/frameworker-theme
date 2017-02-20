wordpressApp.service('scramblrService', function($sce){
  var that = this;

  // SCRAMBLR TEST
  that.toScrambleString = '';

  that.scrambleIt = function(type) {
    var scramble = S$(that.toScrambleString);

    if (type === 'basic'){
      that.scrambledString = scramble.basicScramble().randomCharString;
    } else if (type.indexOf('unicode') !== -1) {
      that.scrambledString = scramble.unicodeSorted(type).sortedString;
      that.scrambledString = $sce.trustAsHtml(that.scrambledString);
    } else {
      that.log.error('Scramble type ' + type + ' is not yet part of the scramble library. You can have your original string back.');
      that.scrambledString = that.toScrambleString;
    }
    return that.scrambledString;
  };
});
