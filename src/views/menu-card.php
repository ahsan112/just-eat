<!-- <div class="p-4 bg-white border border-gray-200 mb-2" onclick=openModal( <?php echo json_encode($pizza) ?> ) > -->
    <!-- onclick='openModal({ "id":"2", "name":"Cheese & Onion Pizza", "description":"Mozzarella cheese, tomato sauce, onions & herbs", "created_at":"2021-09-13 08:13:43", "updated_at":null, "pizza_types": [ { "id":"1", "pizza_id":"2", "size_id":"1", "price":"5.50", "created_at":"2021-09-13 08:14:07", "updated_at":null, "size":"12\" Deep" }, { "id":"2", "pizza_id":"2", "size_id":"2", "price":"7.50", "created_at":"2021-09-13 08:14:21", "updated_at":null,"size":"12\" Stuffed Crust" }, { "id":"3", "pizza_id":"2", "size_id":"3", "price":"9.00", "created_at":"2021-09-13 08:15:11", "updated_at":null,"size":"16\" Thin Family" }, { "id":"4", "pizza_id":"2", "size_id":"4", "price":"9.50", "created_at":"2021-09-13 08:15:14", "updated_at":null, "size":"12\" Stuffed Calzone" } ] } )' -->
    
<div 
    onclick='openModal(<?php echo json_encode($pizza) ?> )' 
    class="p-4 bg-white border border-gray-200 mb-2 cursor-pointer"
>
    <div>
        <div class="text-xl text-gray-800 font-medium"><?= $pizza['name'] ?></div>
        <div class="mt-2 text-sm text-gray-800"><?= $pizza['description'] ?></div>
        <div class="mt-2 text-sm text-blue-700">from £5.50</div>
        <!-- <form action="/cart/add" method="POST">
            <?php foreach ($pizza['pizza_types'] as $type):?>
                <div><?= $type['size']  ?></div>
                <div><?= $type['price'] ?></div>
                <input required type="radio" name="pizza_type_id" value=<?= $type['id'] ?>>
            <?php endforeach?>
                
            <div style="margin-top: 5%;">Optional Extra Toppings</div>
            <?php foreach ($extraToppings as $topping):?>
                <div><?= $topping['name']  ?></div>
                <div><?= $topping['price'] ?></div>
                <input type="checkbox" name="extra_toppings[<?= $topping['id'] ?>]" value=<?= $topping['id'] ?>>
            

            <?php endforeach?>
            <div>
                <label for="">quantity</label>
                <input type="number" name="qty" id="" value="1">
            </div>
            <button type="submit">Add to cart</button>
        </form> -->
    </div>

</div>

<!-- for multi qty in toppings -->
 <!-- <input type="checkbox" name="extra_toppings[<?= $topping['id'] ?>]['topping_id']" value=<?= $topping['id'] ?>> -->
<!-- <input type="number" name="extra_toppings[<?= $topping['id']?>][qty]" > -->


<!-- {
    "id":"2",
    "name":"Cheese & Onion Pizza",
    "description":"Mozzarella cheese, tomato sauce, onions & herbs",
    "created_at":"2021-09-13 08:13:43",
    "updated_at":null,
    "pizza_types":
    [
        {
            "id":"1",
            "pizza_id":"2",
            "size_id":"1",
            "price":"5.50",
            "created_at":"2021-09-13 08:14:07",
            "updated_at":null,
            "size":"12\" Deep"
        },
        {
            "id":"2",
            "pizza_id":"2",
            "size_id":"2",
            "price":"7.50",
            "created_at":"2021-09-13 08:14:21",
            "updated_at":null,"size":"12\" Stuffed Crust"
        },
        {
            "id":"3",
            "pizza_id":"2",
            "size_id":"3",
            "price":"9.00",
            "created_at":"2021-09-13 08:15:11",
            "updated_at":null,"size":"16\" Thin Family"
        },
        {
            "id":"4",
            "pizza_id":"2",
            "size_id":"4",
            "price":"9.50",
            "created_at":"2021-09-13 08:15:14",
            "updated_at":null,
            "size":"12\" Stuffed Calzone"
        }
    ]
}; -->