fetch('/smart-ads-auto-placements')
  .then((response) => response.json())
  .then((ads) => {
    ads.forEach(function(ad){
      let placements = JSON.parse(ad.placements);
      placements.forEach(function(placement){
          var adSelector = document.querySelector(placement.selector);
          if(adSelector){
            let adBody = "<div id=\"smart-ad\" ad-slug=\""+ad.slug+"\">"+ad.body+"</div>"
            adSelector.insertAdjacentHTML(placement.position, adBody);
          }
      });
    });
});