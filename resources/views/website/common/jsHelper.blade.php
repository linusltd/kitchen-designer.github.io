const _token = "{{ csrf_token() }}";
/*Getting Cart Count*/
function getCartCount(){
    $.ajax({
        url:"{{ route('website.cart.get.cart.count') }}",
        method:"GET",
        success:function(response){
            $('#cart__count').html(response)
        },error:function(xhr){
            console.log(xhr.responseText)
        }
    })
}

/*Getting Cart Total*/
function getCartTotal(){
    $.ajax({
        url:"{{ route('website.cart.get.cart.total') }}",
        method:"GET",
        success:function(response){
            $('#cart__total').html(`Rs.${response}`)
        },error:function(xhr){
            console.log(xhr.responseText)
        }
    })
}
