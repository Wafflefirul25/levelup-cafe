// Progressive enhancement: the server still validates and prices every booking.
const category=document.querySelector('#category');
category?.addEventListener('change',()=>document.querySelectorAll('[data-category]').forEach(card=>{card.hidden=category.value!=='all'&&card.dataset.category!==category.value;}));
const form=document.querySelector('#booking-form');
if(form){
 const seat=form.querySelector('#seat'),hours=form.querySelector('#hours'),start=form.querySelector('#start');
 function update(){const rate=Number(seat.selectedOptions[0]?.dataset.rate);document.querySelector('#estimate').textContent=rate?'Estimated total: B$'+(rate*Number(hours.value)).toFixed(2):'Choose a seat to estimate the price.';}
 form.addEventListener('change',update);update();
 form.addEventListener('submit',event=>{const end=Number(start.value.slice(0,2))+Number(hours.value);const error=end>22?'Your session must end by 22:00. Choose an earlier time or shorter duration.':'';document.querySelector('#form-error').textContent=error;if(error)event.preventDefault();});
}
