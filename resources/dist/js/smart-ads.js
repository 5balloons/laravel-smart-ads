fetch('/smart-ads-auto-placements')
  .then((response) => response.json())
  .then((ads) => {
    ads.forEach(function(ad){
      let placements = JSON.parse(ad.placements);
      placements.forEach(function(placement){
          var adSelector = document.querySelector(placement.selector);
          if(adSelector){
            let adBody = "<div class=\"smart-ad-temp\" ad-slug=\""+ad.slug+"\">"+ad.body+"</div>"
            adSelector.insertAdjacentHTML(placement.position, adBody);
          }
      });
      var smartAd = document.querySelector('.smart-ad-temp');
      smartAd.firstChild.setAttribute("ad-slug", ad.slug);
      smartAd.firstChild.classList.add("smart-ad");
      document.querySelectorAll(".smart-ad-temp").forEach(EL => EL.replaceWith(...EL.childNodes));
      document.querySelector('.smart-ad').addEventListener('click', updateClick);
    });
});

function updateClick(e){
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
     let slug = e.target.closest('.smart-ad').getAttribute('ad-slug');
     fetch('/smart-ads-update-clicks', {
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




