let cart = [];
let allGames = []; 

fetch("http://localhost/PixelHub2/getGames.php")
  .then((response) => response.json())
  .then((result) => {
    allGames = result; 
    renderProducts(allGames);
  })
  .catch((error) => console.error(error));

function renderProducts(result) {
  let products = document.getElementById("games");
  products.innerHTML = "";
  result.forEach((item) => {
    products.innerHTML += `
      <div class="game-card">
        <img src="${item.image}" alt="${item.name}">
        <h3>${item.name}</h3>
        <p>${item.des}</p>
        <p class="price">${item.price} $</p>
        <button onclick="addToCart(${item.id})">Add To Cart</button>
      </div>
    `;
  });
}

// Add product to cart
function addToCart(id) {
  let product = allGames.find((item) => Number(item.id) === Number(id)); 
  if (product) {
    let existing = cart.find(item => item.id === product.id);
    if (existing) {
      existing.quantity += 1;
    } else {
      product.quantity = 1;
      cart.push(product);
    }
    renderCart();
    updateCartCount();
  }
}

// Render Cart Sidebar
function renderCart() {
  let cartItemsDiv = document.getElementById("cartItems");
  let cartTotalSpan = document.getElementById("cartTotal");
  cartItemsDiv.innerHTML = "";
  let total = 0;

  cart.forEach((item, index) => {
    total += parseFloat(item.price) * item.quantity;

    let div = document.createElement("div");
    div.innerHTML = `
      <h5>${item.name}</h5>
      <p>${item.price} $</p>
      <label>Quantity: 
        <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)" style="width:60px; text-align:center;"/>
      </label>
      <button onclick="removeFromCart(${index})">Remove</button>
      <hr>
    `;
    cartItemsDiv.appendChild(div);
  });

  cartTotalSpan.textContent = total.toFixed(2);
}

// Update Quantity
function updateQuantity(index, value) {
  const qty = parseInt(value);
  if (qty > 0) {
    cart[index].quantity = qty;
    renderCart();
    updateCartCount();
  }
}

// Remove product 
function removeFromCart(index) {
  cart.splice(index, 1);
  renderCart();
  updateCartCount();
}

// Update cart count in icon
function updateCartCount() {
  document.getElementById("cartCount").textContent = cart.length;
}

// Open & Close Cart Sidebar
document.getElementById("cartIcon").addEventListener("click", () => {
  document.getElementById("cartSidebar").style.right = "0";
});

document.getElementById("cartCloseBtn").addEventListener("click", () => {
  document.getElementById("cartSidebar").style.right = "-400px";
});

// Checkout Button
document.getElementById("checkoutBtn").addEventListener("click", () => {
  localStorage.setItem("cartItems", JSON.stringify(cart));
  window.location.href = "checkout.html";
});