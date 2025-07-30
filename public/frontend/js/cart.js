$(document).ready(function(){
    count();
    $('.addToCart').click(function(){
        //alert("OK");
        let id = $(this).data('id');
        let image = $(this).data('image');
        let name = $(this).data('name');
        let price = $(this).data('price');
        //console.log(id,name,price);
        let items = {
            id: id,
            name: name,
            image: image,
            price:price,
            qty: 1
        }
        let itemstring = localStorage.getItem('bookCart');
        let itemArray;
        if(itemstring == null){
            itemArray = [];
        }else{
            itemArray = JSON.parse(itemstring);
        }

        let status = false;
        $.each(itemArray, function(i,v){
            if(id == v.id){
                v.qty++;
                status = true;
            }
        })
        if (status == false) {
            itemArray.push(items);
        }
        
        let itemdata = JSON.stringify(itemArray);
        localStorage.setItem('bookCart', itemdata);
        count();

        
    });

    function count(){
        let itemstring = localStorage.getItem('bookCart');
        if(itemstring){
            let itemArray = JSON.parse(itemstring);
            //console.log(itemArray);
            
            let count = 0;
            $.each(itemArray, function(i,v){
                if(itemArray != 0){
                    count += v.qty;
                    $('#item-count').text(count);
                }else{
                    $('#item-count').text('0')
                }
            })
        }
    }
    getdata();
    function getdata(){
        $('#return_home').hide();
        let hasProduct = true;
        let itemstring = localStorage.getItem('bookCart');
        if(itemstring){
            let itemArray = JSON.parse(itemstring);
            if(itemArray.length == 0){
                hasProduct = false;
            }


            let data = '';
            let no = 1;
            let total = 0;
            $.each(itemArray,function(i,v){
                let name = v.name;
                let image = v.image;
                let price = v.price;
                let qty = v.qty;

                data += `<tr>
                                <th scope="row" class="align-middle">${no++}</th>
                                <td class="fw-bold align-middle">
                                    <img src="${image}" alt="" style="width: 9%" class="align-middle">
                                    ${name}</td>
                                <td class="align-middle"><button class="min" data-key="${i}"> - </button>
                                ${qty}
                                <button class="max" data-key="${i}"> + </button></td>
                                <td class="align-middle">${price}</td>
                                <td class="align-middle">${price * qty}</td>
                                <td  class="align-middle">
                                    <button class="btn btn-outline-danger delete"><i class="bi bi-trash"></i></button>
                                    
                                </td>
                                </tr>`;

                        total += price * qty;
                        
            })
            

            data += `
                    
                <tr>
                    <td colspan="4" align="right">Total : </td>
                    <td>${total}</td>
                        <td></td>


                    </tr>
                    `;

            $('tbody').html(data);
            
        }else{
            hasProduct = false;
        } 
        if (!hasProduct) {
            $('tbody').html('<tr><td colspan="6" class="text-center">No Product Found</td></tr>');
            $('#return_home').show();
            
        }

    }
    // Qty Input Change
    
//    $('tbody').on('change', 'input[type="number"]', function () {
//     let newQty = parseInt($(this).val()); // get new value from input
//     let index = $(this).closest('tr').index(); // get item index by table row

//     if (isNaN(newQty) || newQty <= 0) {
//         alert("Invalid quantity");
//         getdata(); // reset UI
//         return;
//     }

//     let itemstring = localStorage.getItem('bookCart');
//     if (itemstring) {
//         let itemArray = JSON.parse(itemstring);
//         if (index < itemArray.length) {
//             itemArray[index].qty = newQty;

//             let itemdata = JSON.stringify(itemArray);
//             localStorage.setItem('bookCart', itemdata);
//             getdata();
//             count();
//         }
//     }
//     });

    $('tbody').on('click','.delete',function(){
        let key = $(this).data('key');
        // alert("sksdjkjdf");
        let itemstring = localStorage.getItem('bookCart');
        if(itemstring){
            let itemArray = JSON.parse(itemstring);
                let ans = confirm('Are you sure remove');
                if (ans) {
                    itemArray.splice(key,1);

                    
                }else{
                    v.qty = 1;
                }
            let itemdata = JSON.stringify(itemArray);
            localStorage.setItem('bookCart',itemdata);
            getdata();
            count();
        }
    })

    $('tbody').on('click','.min',function(){
        let key = $(this).data('key');
        // alert("sksdjkjdf");
        let itemstring = localStorage.getItem('bookCart');
        if(itemstring){
            let itemArray = JSON.parse(itemstring);
            $.each(itemArray, function(i,v){
                if(key == i){
                    v.qty--;
                    if(v.qty== 0){
                        let ans = confirm('Are you sure remove');
                        if (ans) {
                            itemArray.splice(key,1);

                            
                        }else{
                            v.qty = 1;
                        }
                    }
                }
            })
            let itemdata = JSON.stringify(itemArray);
            localStorage.setItem('bookCart',itemdata);
            getdata();
            count();
        }
    })
    $('tbody').on('click','.max',function(){
        let key = $(this).data('key');
        //alert("sksdjkjdf");
        let itemstring = localStorage.getItem('bookCart');
        if(itemstring){
            let itemArray = JSON.parse(itemstring);
            $.each(itemArray, function(i,v){
                if(key == i){
                    v.qty++;
                    
                }
            })
            let itemdata = JSON.stringify(itemArray);
            localStorage.setItem('bookCart',itemdata);
            getdata();
            count();
        }
    })
});