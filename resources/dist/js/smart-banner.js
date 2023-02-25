fetch('/smart-banner-auto-placements')
  .then((response) => response.json())
  .then((ads) => {
    ads.forEach(function(ad){
      //Check if ad is enabled
      if(ad.enabled){
      //Loop through the ads and auto place them using insertAdjacentHTML
      let placements = JSON.parse(ad.placements);
      placements.forEach(function(placement){
          if(placement.selector){
            var adSelector = document.querySelector(placement.selector);
            if(adSelector){
              let adBody = '';
              if(ad.adType == 'HTML'){
                adBody = "<div class=\"smart-banner-temp\" banner-slug=\""+ad.slug+"\" style=\""+placement.style+"\">"+ad.body+"</div>"
              }else if(ad.adType == 'IMAGE'){
                adBody = "<div class=\"smart-banner-temp\" banner-slug=\""+ad.slug+"\" style=\""+placement.style+"\">\
                          <a href=\""+(ad.imageUrl ? ad.imageUrl : '#')+"\" target=\"_blank\">\
                            <img src=\"/storage/"+ad.image+"\" alt=\""+ad.imageAlt+"\" />\
                          </a>\
                         </div>"
              }
              adSelector.insertAdjacentHTML(placement.position, adBody);
            }
          }
        });
      }
    });

    //Remove the parent temp element (smart-ad-temp), since it messes with the CSS Design for some ads 
    var smartAds = document.querySelectorAll('.smart-banner-temp');
    //console.log(smartAds);
    smartAds.forEach(function(smartAd){
      let adSlug = smartAd.getAttribute('banner-slug');
      let adStyles = smartAd.getAttribute('style');
      smartAd.firstElementChild.setAttribute("banner-slug", adSlug);
      smartAd.firstElementChild.setAttribute("style", adStyles);
      smartAd.firstElementChild.classList.add("smart-banner");
      smartAd.replaceWith(...smartAd.childNodes);
    });

    var smartAds = document.querySelectorAll('.smart-banner');
    smartAds.forEach(function(smartAd){
        smartAd.addEventListener('click', updateClick);
    });

});

//Event listener function for updating clicks 
function updateClick(e){
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
     let slug = e.target.closest('.smart-banner').getAttribute('banner-slug');
     fetch('/smart-banner-update-clicks', {
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json, text-plain, */*",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-TOKEN": token
              },
             method: 'post',
             credentials: "same-origin",
             body: JSON.stringify({
                 slug: slug,
             })
      }).catch(function(error) {
             console.log(error);
      });
}




