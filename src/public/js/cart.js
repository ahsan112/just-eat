function openModal(pizza)
{
    console.log('product', pizza);
    let modal = document.querySelector('#menu-modal');
    modal.style.display = 'block';
    
    displayPizzaDetails(pizza);
}

function closeModal()
{
    
    let modal = document.querySelector('#menu-modal');
    modal.style.display = 'none';
    reset();
}

function reset()
{ 
    deSelectAllToppings();
    disableAddToCart();
    setTotal("0.00");
}

function displayPizzaDetails(pizza)
{
    let name = document.querySelector('#pizza-name');
    name.innerHTML = pizza.name;

    let description = document.querySelector('#pizza-description');
    description.innerHTML = pizza.description;

    let pizzaTypes = buildPizzaTypes(pizza.pizza_types);
    let pizzaTypesDiv = document.querySelector('#pizza-types');
    pizzaTypesDiv.innerHTML = pizzaTypes;
}

function buildPizzaTypes(pizzaTypes)
{
    var pizzaTypeHtml = '';

    pizzaTypes.forEach(type => {
        pizzaTypeHtml +=
        `<div class="border-b border-gray-300">
            <div >
                <input data-price=${type.price} onchange="setTotal(${type.price})"class="selected-input absolute overflow-hidden -m-px h-px w-px" type="radio" name="pizza_type_id" value="${type.id}" id="${type.id}">
                <label class="selected-label flex wrap justify-between relative w-full cursor-pointer text-sm font-light" for="${type.id}">
                    <span class="selected-name items-center text-gray-800 flex flex-1 flex-wrap text-left p-4">
                        <span>${type.size}</span>
                        <span class="flex self-center ml-auto">${type.price}</span>
                    </span>
                </label>
            </div>
        </div>`
    });
    
    return pizzaTypeHtml;
}

function updateTotal(select, amount)
{
    let totalDiv = document.querySelector('#total-value');
    let total = parseFloat(document.querySelector('#total-value').innerHTML.substr(1));
    let amountToAdd = parseFloat(amount);
    let qty = parseFloat(document.querySelector('#qty-value').innerHTML);


    if (select.checked) {
        total += amountToAdd * qty;
        totalDiv.innerHTML = '£' + parseFloat(total).toFixed(2);
    }
    else 
    {
        total -= amountToAdd * qty;
        totalDiv.innerHTML = '£' + parseFloat(total).toFixed(2);
    }
}

function setTotal(amount)
{
    deSelectAllToppings();
    enableAddToCart();
    let totalDiv = document.querySelector('#total-value');
    totalDiv.innerHTML = '£' + parseFloat(amount).toFixed(2);

}

function enableAddToCart()
{
    btn = document.querySelector('#add-btn');
    btn.style.background = '#f36d00';
    btn.style.color = 'white';
    btn.disabled = false;
}
function disableAddToCart()
{
    btn = document.querySelector('#add-btn');
    // btn.style.color = null;
    btn.style.removeProperty('background');
    btn.style.removeProperty('color');
    btn.style.setProperty('color', 'black');
    btn.style.setProperty('background', 'gray');
    // btn.style.background = null;
    console.log('disabled', btn);
}

function deSelectAllToppings()
{
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = false;
    }
}

function updateQty(value)
{
    let totalDiv = document.querySelector('#qty-value');
    let totalHiddenDiv = document.querySelector('#qty-value-hidden');
    totalDiv.innerHTML = value;
    totalHiddenDiv.value = value;

}

function increaseQty()
{
    let qty = parseFloat(document.querySelector('#qty-value').innerHTML);
    updateQty(qty+1);
    updateTotalQty();
}

function decreaseQty()
{
    let qty = parseFloat(document.querySelector('#qty-value').innerHTML);
    updateQty(qty-1);
    updateTotalQty();
    getSelectedPizzaTypeTotal();
    selectedToppingsTotalValue();
}

function updateTotalQty()
{
    let pizzaTotal = getSelectedPizzaTypeTotal();
    let toppingsTotal = getToppingsTotal();
    let qty = parseFloat(document.querySelector('#qty-value').innerHTML);

    pizzaTotal = pizzaTotal * qty;
    toppingsTotal = toppingsTotal * qty;

    let total = pizzaTotal + toppingsTotal;
    let totalDiv = document.querySelector('#total-value');

    totalDiv.innerHTML = '£' + parseFloat(total).toFixed(2);
}



function getSelectedPizzaTypeTotal()
{
    total = parseFloat(document.querySelector('input[name="pizza_type_id"]:checked').dataset.price);

    return total;
}

function getToppingsTotal()
{
    let total = 0.00;

    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    for (var checkbox of checkboxes) {
        total += parseFloat(checkbox.dataset.toppingprice);       
    }

    console.log(total); 
    return total;
}

function updateDelivery(select)
{
    if (select.dataset.delivery == 1) {
        console.log('delivery...');
        select.parentElement.classList.add('delivery-switcher--active')
        document.querySelector('#collection-label').classList.remove('delivery-switcher--active')
    }
    else if (select.dataset.collection == 1)
    {
        console.log('collection... ');
        select.parentElement.classList.add('delivery-switcher--active')
        document.querySelector('#delivery-label').classList.remove('delivery-switcher--active')

    }
}
