// FAQ interactive enhancements
document.addEventListener('DOMContentLoaded', function(){
  // Smooth collapse toggle icon rotation handled via CSS, but add keyboard accessibility
  var buttons = document.querySelectorAll('.btn-link');
  buttons.forEach(function(btn){
    btn.addEventListener('keydown', function(e){
      if(e.key === 'Enter' || e.key === ' '){
        e.preventDefault();
        btn.click();
      }
    });
  });

  // Add small animation when collapsing/expanding
  var collapses = document.querySelectorAll('.collapse');
  collapses.forEach(function(c){
    // Listen for Bootstrap 5 collapse events
    c.addEventListener('show.bs.collapse', function(){
      c.style.transition = 'height 250ms ease';
    });
    c.addEventListener('hide.bs.collapse', function(){
      c.style.transition = 'height 200ms ease';
    });

    // Add expanded class on parent header button (for older browsers or extra styling)
    c.addEventListener('shown.bs.collapse', function(){
      var btn = document.querySelector('[aria-controls="' + c.id + '"]');
      if(btn) btn.setAttribute('aria-expanded', 'true');
    });
    c.addEventListener('hidden.bs.collapse', function(){
      var btn = document.querySelector('[aria-controls="' + c.id + '"]');
      if(btn) btn.setAttribute('aria-expanded', 'false');
    });
  });

  // Optional: subtle lift on hover for non-touch devices
  var cards = document.querySelectorAll('.card');
  cards.forEach(function(card){
    card.addEventListener('mouseenter', function(){ if(!('ontouchstart' in window)){ card.style.transform = 'translateY(-3px)'; card.style.transition='transform .18s ease'; } });
    card.addEventListener('mouseleave', function(){ card.style.transform = 'none'; });
  });
});
