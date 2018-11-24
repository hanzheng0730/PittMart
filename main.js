$(document).ready(function(){
	cat();
	product();
	//cat() is a funtion fetching category record from database whenever page is load
	function cat(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{category:1},
			success	:	function(data){
				$("#get_category").html(data);
				
			}
		})
	}
	//product() is a funtion fetching product record from database whenever page is load
    function product(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getProduct:1},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	}
    // admin start here
    admin_product();
    function admin_product(){
        $.ajax({
            url    :    "action.php",
            method:    "POST",
            data    :    {adminGetProduct:1},
            success    :    function(data){
            $("#admin_get_product").html(data);
            }
        })
    }
   
    admin_customer();
    function admin_customer(){
        $.ajax({
            url    :    "action.php",
            method:    "POST",
            data    :    {adminGetCustomer:1},
            success    :    function(data){
            $("#admin_get_customer").html(data);
            }
        })
    }

    admin_order();
    function admin_order(){
        $.ajax({
            url    :    "action.php",
            method:    "POST",
            data    :    {adminGetOrder:1},
            success    :    function(data){
            $("#admin_get_order").html(data);
            }
        })
    }
    
                  
                  
    // admin end here
                  
                  
	/*	when page is load successfully then there is a list of categories when user click on category we will get category id and 
		according to id we will show products
	*/
	$("body").delegate(".category","click",function(event){
		event.preventDefault();
		var cid = $(this).attr('cid');
		
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{get_seleted_Category:1,cat_id:cid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})

	/*
		search
	*/
    
	$("#search_btn").click(function(event){
        event.preventDefault();
		$("#get_product").html("");
		var keyword = $("#search").val();
        //console.log("keywrod="+keyword);
        
		if(keyword != ""){
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{search:1,keyword:keyword},
			success	:	function(data){ 
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
		}

	})
	//end


	/*
		Here #login is login form id and this form is available in index.php page
		from here input data is sent to login.php page
		if you get login_success string from login.php page means user is logged in successfully and window.location is 
		used to redirect user from home page to profile.php page
	*/
	$("#login").on("submit",function(event){
		event.preventDefault();
		$.ajax({
			url	:	"login.php",
			method:	"POST",
			data	:$("#login").serialize(),
			success	:function(data){
				if(data == "login_success"){
					window.location.href = "profile.php";
				} else if (data == "cart_login"){
					window.location.href = "cart.php";
				}else{
					$("#e_msg").html(data);
				}
			}
		})
	})
	//end

	//Get User Information before checkout
	$("#signup_form").on("submit",function(event){
		event.preventDefault();
		//$(".overlay").show();
		$.ajax({
			url : "register.php",
			method : "POST",
			data : $("#signup_form").serialize(),
			success : function(data){
				//$(".overlay").hide();
				if (data == "register_success") {
					window.location.href = "cart.php";
				}else{
					$("#signup_msg").html(data);
				}
				
			}
		})
	})
	//Get User Information before checkout end here

    //Get User Information before checkout
    $("#checkout_form").on("submit",function(event){
        event.preventDefault();
        $.ajax({
            url : "process.php",
            method : "POST",
            data : $("#checkout_form").serialize(),
            success : function(data){
                console.log("here:"+data);
                if (data == "success") {
                    window.location.href = "success.php";
                }else{
                    $("#checkout_msg").html(data);
                }
            }
        })
    })
                  
                  
                  
                  
	//Add Product into Cart
	$("body").delegate("#product","click",function(event){
		var pid = $(this).attr("pid");
		event.preventDefault();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {addToCart:1,proId:pid},
			success : function(data){
				count_item();
				getCartItem();
				$('#product_msg').html(data);
			}
		})
	})
	//Add Product into Cart End Here
	//Count user cart items funtion
	count_item();
	function count_item(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {count_item:1},
			success : function(data){
				$(".badge").html(data);
			}
		})
	}
	//Count user cart items funtion end

	//Fetch Cart item from Database to dropdown menu
	getCartItem();
	function getCartItem(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,getCartItem:1},
			success : function(data){
				$("#cart_product").html(data);
			}
		})
	}

                  
                  
	//Fetch Cart item from Database to dropdown menu

	/*
		Whenever user change qty we will immediate update their total amount by using keyup funtion
		but whenever user put something(such as ?''"",.()''etc) other than number then we will make qty=1
		if user put qty 0 or less than 0 then we will again make it 1 qty=1
		('.total').each() this is loop funtion repeat for class .total and in every repetation we will perform sum operation of class .total value 
		and then show the result into class .net_total
	*/

	$("body").delegate(".qty","keyup",function(event){
		//event.preventDefault();
        if ($(".qty").is(":focus") && event.key == "Enter") {
            var row = $(this).parent().parent().parent().parent();
            var price = row.find('.price').val();
            var qty = row.find('.qty').val();
            var update_id = row.find('.pid').val();
            //console.log(update_id);
                       
            if (isNaN(qty)) {
                qty = 1;
            };
            if (qty < 1) {
                qty = 1;
            };
            var total = price * qty;
            row.find('.total').val(total);
            $.ajax({
                url    :    "action.php",
                method    :    "POST",
                data    :    {updateCartItem:1,update_id:update_id,qty:qty},
                success    :    function(data){
                    checkOutDetails();
                }
            })
        }

	})
	//Change Quantity end here 

	/*
		whenever user click on .remove class we will take product id of that row 
		and send it to action.php to perform product removal operation
	*/
	$("body").delegate(".remove","click",function(event){
		var remove = $(this).parent().parent().parent();
		var remove_id = remove.find(".remove").attr("remove_id");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{removeItemFromCart:1,rid:remove_id},
			success	:	function(data){
				$("#cart_msg").html(data);
				checkOutDetails();
			}
		})
	})
    $("body").delegate(".admin-p-remove","click",function(event){
        var remove = $(this).parent().parent();
        var remove_id = remove.find(".admin-p-remove").attr("remove_id");
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {adminRemoveProduct:1,rid:remove_id},
            success    :    function(data){
               $("#admin_msg").html(data);
               admin_product();
            }
        })
    })
    $("body").delegate(".admin-p-add","click",function(event){
        var add = $(this).parent().parent();
        var product_kind_id = add.find(".product_kind_id").val();
        var name = add.find(".name").val();
        var keywords = add.find(".keywords").val();
        var image = add.find(".image").val().replace(/\\/g, '/').replace(/.*\//, '');
        var inventory_amount = add.find(".inventory_amount").val();
        var price = add.find(".price").val();
        var cost = add.find(".cost").val();
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {adminAddProduct:1,product_kind_id:product_kind_id,name:name,keywords:keywords,image:image,inventory_amount:inventory_amount,price:price,cost:cost},
            success    :    function(data){
                $("#admin_msg").html(data);
               admin_product();
            }
        })
    })
	/*
		whenever user click on .update class we will take product id of that row 
		and send it to action.php to perform product qty updation operation
	*/
	$("body").delegate(".update","click",function(event){
		var update = $(this).parent().parent();
		var update_id = update.find(".update").attr("update_id");
		var qty = update.find(".qty").val();
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{updateCartItem:1,update_id:update_id,qty:qty},
			success	:	function(data){
				$("#cart_msg").html(data);
				checkOutDetails();
			}
		})
	})
                  
    $("body").delegate(".admin-p-update","click",function(event){
        var update = $(this).parent().parent();
        var update_id = update.find(".admin-p-update").attr("update_id");
        var product_kind_id = update.find(".product_kind_id").val();
        var name = update.find(".name").val();
        var keywords = update.find(".keywords").val();
        var image = update.find(".image").val().replace(/\\/g, '/').replace(/.*\//, '');
        if(!image) image = update.find(".image").attr("fn");
        var inventory_amount = update.find(".inventory_amount").val();
        var price = update.find(".price").val();
        var cost = update.find(".cost").val();

        $.ajax({
            url    :    "action.php",
            method    :    "POST",
               data    :    {adminUpdateProduct:1,update_id:update_id,product_kind_id:product_kind_id,name:name,keywords:keywords,image:image,inventory_amount:inventory_amount,price:price,cost:cost},
            success    :    function(data){
               $("#admin_msg").html(data);
               admin_product();
            }
        })
    })

    $("body").delegate(".admin-o-remove","click",function(event){
        var remove = $(this).parent().parent();
        var remove_id = remove.find(".admin-o-remove").attr("remove_id");
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {adminRemoveOrderDetail:1,rid:remove_id},
            success    :    function(data){
               $("#admin_msg").html(data);
               admin_order();
            }
        })
    })

    $("body").delegate(".admin-c-remove","click",function(event){
        var remove = $(this).parent().parent();
        var remove_id = remove.find(".admin-c-remove").attr("remove_id");
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {adminRemoveCustomer:1,rid:remove_id},
            success    :    function(data){
               $("#admin_msg").html(data);
               admin_customer();
            }
        })
    })


    $("body").delegate(".admin-o-update","click",function(event){
        var update = $(this).parent().parent();
        var update_id = update.find(".admin-o-update").attr("update_id");
        var order_detail_id = update.find(".order_detail_id").val();
        var o_id = update.find(".o_id").val();
        var p_id = update.find(".p_id").val();
        var c_id = update.find(".c_id").val();
        var qty = update.find(".qty").val();
        var store_id = update.find(".store_id").val();
        var employee_id = update.find(".employee_id").val();
        var shipping_st = update.find(".shipping_st").val();
        var city = update.find(".city").val();
        var state = update.find(".state").val();
        var zip = update.find(".zip").val();
        var time = update.find(".time").val();

        $.ajax({
            url    :    "action.php",
            method    :    "POST",
               data    :    {adminUpdateOrderDetail:1,update_id:update_id,p_id:p_id,c_id:c_id,qty:qty,store_id:store_id,employee_id:employee_id,shipping_st:shipping_st,city:city,state:state,zip:zip,time:time},
            success    :    function(data){
               $("#admin_msg").html(data);
               admin_order();
            }
        })
    })

    $("body").delegate(".admin-c-update","click",function(event){
        var update = $(this).parent().parent();
        var update_id = update.find(".admin-c-update").attr("update_id");
        var first_name = update.find(".first_name").val();
        var last_name = update.find(".last_name").val();
        var phone_number = update.find(".phone_number").val();
        var email = update.find(".email").val();
        var street = update.find(".street").val();
        var city = update.find(".city").val();
        var state = update.find(".state").val();
        var zip = update.find(".zip").val();
        var home_or_business = update.find(".home_or_business").val();
        var business_category = update.find(".business_category").val();
        var annual_income = update.find(".annual_income").val();
        var married = update.find(".married").val();
        var gender = update.find(".mgender").val();
        var birth_year = update.find(".birth_year").val();

        $.ajax({
            url    :    "action.php",
            method    :    "POST",
               data    :    {adminUpdateCustomer:1,update_id:update_id,first_name:first_name,last_name:last_name,phone_number:phone_number,email:email,street:street,city:city,state:state,zip:zip,home_or_business:home_or_business,business_category:business_category,annual_income:annual_income,married:married,gender:gender,birth_year:birth_year},
            success    :    function(data){
               $("#admin_msg").html(data);
               admin_customer();
            }
        })
    })

	checkOutDetails();
    payment();
	net_total();
	/*
		checkOutDetails() function work for two purposes
		First it will enable php isset($_POST["Common"]) in action.php page and inside that
		there is two isset funtion which is isset($_POST["getCartItem"]) and another one is isset($_POST["checkOutDetials"])
		getCartItem is used to show the cart item into dropdown menu 
		checkOutDetails is used to show cart item into Cart.php page
        paymentDetails is used to show the total in checkout.php page
	*/
	function checkOutDetails(){
	 //$('.overlay').show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,checkOutDetails:1},
			success : function(data){
				//$('.overlay').hide();
				$("#cart_checkout").html(data);
					net_total();
			}
		})
	}
    function payment(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {Common:1,payment:1},
            success : function(data){
            $("#payment").html(data);
               net_total();
            }
        })
    }
                  
                  
	/*
		net_total function is used to calcuate total amount of cart item
	*/
	function net_total(){
		var net_total = 0;
		$('.qty').each(function(){
			var row = $(this).parent().parent().parent().parent();
			var price  = row.find('.price').val();
			var total = price * $(this).val()-0;
			row.find('.total').val(total);
            row.find('.sub_total').html("$" +total);
            row.find('.single_price').html("$" +price + ' ea.');
		})
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
        
        var tax = net_total*0.06;
        var total = net_total*1.06;
        $('.net_total').html("Subtotal: <span style='float:right;'>$" +net_total + "</span><br>Shipping: <span style='float:right;'>Free</span><br>Est Tax: <span style='float:right;'>$" + tax.toFixed(2) + "</span><hr> <b> Total: <span style='float:right;'>$" + total.toFixed(2) +"</b></span>");
	}


    // page
	page();
	function page(){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{page:1},
			success	:	function(data){
				$("#pageno").html(data);
			}
		})
	}
	$("body").delegate("#page","click",function(){
		var pn = $(this).attr("page");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
               data	:	{getProduct:1,setPage:1,pageNumber:pn},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	})
    admin_p_page();
    function admin_p_page(){
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {admin_p_page:1},
            success    :    function(data){
            $("#adminppageno").html(data);
            }
        })
    }
    $("body").delegate("#admin_p_page","click",function(){
        var pn = $(this).attr("page");
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {adminGetProduct:1,setAdminProdcutPage:1,adminProductPageNumber:pn},
            success    :    function(data){
            $("#admin_get_product").html(data);
            }
        })
    })
                       
    admin_o_page();
    function admin_o_page(){
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {admin_o_page:1},
            success    :    function(data){
            $("#adminopageno").html(data);
        }
        })
    }
    $("body").delegate("#admin_o_page","click",function(){
        var pn = $(this).attr("page");
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {adminGetOrder:1,setAdminOrderPage:1,adminOrderPageNumber:pn},
            success    :    function(data){
            $("#admin_get_order").html(data);
        }
        })
    })
    $("body").delegate(".page_go","keyup",function(event){
        //event.preventDefault();
        if ($(".page_go").is(":focus") && event.key == "Enter") {
            var pn = $(this).val();
            var max = parseInt($(this).attr("max"));

            if (isNaN(pn)) pn = 1;
            if (pn < 1) pn = 1;
            if (pn > max) pn = max;
            $(this).val(pn);

            $.ajax({
                url    :    "action.php",
                method    :    "POST",
                data    :    {adminGetOrder:1,setAdminOrderPage:1,adminOrderPageNumber:pn},
                success    :    function(data){
                $("#admin_get_order").html(data);
            }
            })
        }
                                          
    })
     
    admin_c_page();
    function admin_c_page(){
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {admin_c_page:1},
            success    :    function(data){
            $("#admincpageno").html(data);
        }
        })
    }
    $("body").delegate("#admin_c_page","click",function(){
        var pn = $(this).attr("page");
        $.ajax({
            url    :    "action.php",
            method    :    "POST",
            data    :    {adminGetCustomer:1,setAdminCustomerPage:1,adminCustomerPageNumber:pn},
            success    :    function(data){
            $("#admin_get_customer").html(data);
        }
        })
    })
    $("body").delegate(".cpage_go","keyup",function(event){
        //event.preventDefault();
        if ($(".cpage_go").is(":focus") && event.key == "Enter") {
            var pn = $(this).val();
            var max = parseInt($(this).attr("max"));

            if (isNaN(pn)) pn = 1;
            if (pn < 1) pn = 1;
            if (pn > max) pn = max;
            $(this).val(pn);

            $.ajax({
                url    :    "action.php",
                method    :    "POST",
                data    :    {adminGetCustomer:1,setAdminCustomerPage:1,adminCustomerPageNumber:pn},
                success    :    function(data){
                $("#admin_get_customer").html(data);
            }
            })
        }
                                          
    })                  
       
    $("body").delegate(".image","change",function(){
        var c = $(this).parent().parent().parent();
        var image = c.find(".image").val().replace(/\\/g, '/').replace(/.*\//, '');
        c.find(".picture").attr("src", "images/"+image);
    })

})










