let o=[];document.addEventListener("DOMContentLoaded",function(){c(),m()});function c(){const t=localStorage.getItem("mmb-cart");o=t?JSON.parse(t):[],s(),a()}function s(){const t=document.getElementById("cart-items"),n=document.getElementById("empty-cart");if(!(!t||!n)){if(o.length===0){t.classList.add("hidden"),n.classList.remove("hidden");return}n.classList.add("hidden"),t.classList.remove("hidden"),t.innerHTML=o.map(e=>`
      <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-all duration-200">
        <div class="flex-shrink-0">
          <img src="${e.image}" alt="${e.nom}" class="w-16 h-16 object-contain rounded-lg bg-white border border-gray-200">
        </div>
        
        <div class="flex-1 min-w-0">
          <h3 class="text-lg font-semibold text-gray-900">${e.nom}</h3>
          <p class="text-sm text-green-600 font-medium">${e.variete}</p>
          <p class="text-sm text-gray-600">Conditionnement: ${e.conditionnement}</p>
        </div>
        
        <div class="flex items-center space-x-3">
          <div class="flex items-center border border-gray-300 rounded-lg">
            <button 
              type="button" 
              class="px-3 py-1 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-colors duration-200"
              onclick="updateQuantity('${e.id}', -1)"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
              </svg>
            </button>
            <span class="px-3 py-1 text-gray-900 font-medium">${e.quantite}</span>
            <button 
              type="button" 
              class="px-3 py-1 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-colors duration-200"
              onclick="updateQuantity('${e.id}', 1)"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
            </button>
          </div>
          
          <button 
            type="button" 
            class="text-red-500 hover:text-red-700 transition-colors duration-200"
            onclick="removeItem('${e.id}')"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
        </div>
      </div>
    `).join("")}}function u(t,n){const e=o.find(i=>i.id===t);if(!e)return;const r=e.quantite+n;if(r<1){l(t);return}e.quantite=r,d(),s(),a()}function l(t){o=o.filter(n=>n.id!==t),d(),s(),a()}window.updateQuantity=u;window.removeItem=l;function d(){localStorage.setItem("mmb-cart",JSON.stringify(o))}function a(){const t=document.getElementById("cart-summary"),n=document.getElementById("total-items");if(!t||!n)return;const e=o.reduce((r,i)=>r+i.quantite,0);n.textContent=e,t.innerHTML=o.map(r=>`
      <div class="flex justify-between text-sm">
        <span>${r.nom} (${r.conditionnement})</span>
        <span class="font-medium">x${r.quantite}</span>
      </div>
    `).join("")}function m(){const t=document.getElementById("devis-form");t&&t.addEventListener("submit",function(n){if(n.preventDefault(),o.length===0){alert("Votre panier est vide. Veuillez ajouter des produits avant de demander un devis.");return}const e=new FormData(t),r={produits:o,client:{nom:e.get("nom"),email:e.get("email"),telephone:e.get("telephone"),entreprise:e.get("entreprise"),adresse:e.get("adresse"),ville:e.get("ville"),code_postal:e.get("code_postal"),date_livraison:e.get("date_livraison"),commentaires:e.get("commentaires")},date_demande:new Date().toISOString()};console.log("Données du devis:",r),v(),o=[],d(),s(),a(),t.reset()})}function v(){const t=document.createElement("div");t.className="fixed top-32 right-6 bg-green-500 text-white px-6 py-3 rounded-lg shadow-2xl z-50 transform translate-x-full transition-transform duration-300",t.innerHTML=`
      <div class="flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>Demande de devis envoyée avec succès !</span>
      </div>
    `,document.body.appendChild(t),setTimeout(()=>{t.classList.remove("translate-x-full")},100),setTimeout(()=>{t.classList.add("translate-x-full"),setTimeout(()=>{document.body.removeChild(t)},300)},5e3)}
