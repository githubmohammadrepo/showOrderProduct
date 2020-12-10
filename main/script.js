//accept all product in one order
function acceptAllOrder(user_id, button, event) {
    let idNumber = button.getAttribute("data-orderid").replace(/\D/g, '');
    let tdsClassName = '.status' + idNumber;
    var data = {
            user_id: user_id,
            order_id: button.getAttribute("data-orderid"),
            typeAction: "acceptAll"
        }
        // sent ajax request
    jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
        method: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            if (data[0].response == 'ok') {
                button.parentElement.style.color = "green"
                button.parentNode.innerHTML = 'انجام شده'
                let tds = document.querySelectorAll(tdsClassName.toString())
                notificationDisplay(tdsClassName, 'انجام شده', 'transparent', 'white')
                    //send sms to customer
                smsentSmsToCustomers(data);
            } else if (data[0].response == 'other') {
                button.parentNode.innerHTML = 'رد شد'
                removeAlert(false, null);
                notificationDisplay(tdsClassName, 'رد شده', 'transparent', 'red')
            } else {
                button.parentElement.style.color = "blue"
                button.parentNode.innerHTML = 'خطا در عملیات'
                notificationDisplay(tdsClassName, 'خطا در عملیات', 'blue', 'white')
            }
        },
        error: function(xhr) {
            console.log('error', xhr);
            button.parentNode.innerHTML = 'خطا در اینترنت'
            notificationDisplay(tdsClassName, 'خطا در اینترنت', 'red', 'white')
        }
    })
}

function smsentSmsToCustomers(data) {
    let jsonLiveSite = "http://hypertester.ir/index.php?option=com_jchat&format=json";
    postObject = {
        "message": "<?php echo 'خریدار گرامی خرید شما با موفقیت پذیرفته شد'; ?>",
        "task": "stream.saveEntity",
        "to": data[0].customerSessonId.toString(), //error - solved => ownUser sessionId
        "tologged": data[0].storeSessionId.toString()
    };
    jQuery.post(jsonLiveSite, postObject, function(response) {
        postObject = null;
    });
}

// notification display for change display and show notifcation for user
function notificationDisplay(className, textStatus, backgroundColor, color) {
    let tds = document.querySelectorAll(className.toString())
    for (let i = 0; i < tds.length; i++) {
        tds[i].innerHTML = textStatus.toString()
        tds[i].style.backgroundColor = backgroundColor.toString()
        tds[i].style.color = color.toString()
    }
}

//reject all product in one order
function rejectAllOrder(user_id, button, event) {
    let idNumber = button.getAttribute("data-orderid").replace(/\D/g, '');
    let tdsClassName = '.status' + idNumber;
    var data = {
            user_id: user_id,
            order_id: button.getAttribute("data-orderid"),
            typeAction: "rejectAll"
        }
        // sent ajax request
    jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
        method: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            if (data[0] == 'ok') {
                button.parentElement.style.color = "red"
                button.parentNode.innerHTML = 'رد شد'
                notificationDisplay(tdsClassName, 'رد شد', 'transparent', 'red')
            } else {
                button.parentElement.style.color = "blue"
                button.parentNode.innerHTML = 'خطا در عملیات'
                notificationDisplay(tdsClassName, 'خطا در عملیات', 'blue', 'white')
            }
        },
        error: function(xhr) {
            console.log('error', xhr);
            button.parentNode.innerHTML = 'خطا در اینترنت'
            notificationDisplay(tdsClassName, 'خطا در اینترنت', 'red', 'white')
        }
    })
}

//function archive all product in one order
function archiveOrder(user_id, button, event) {
    let trClassName = ".order" + (button.getAttribute("data-orderid").toString())
    var data = {
            user_id: user_id,
            order_id: button.getAttribute("data-orderid"),
            typeAction: "archive"
        }
        // sent ajax request
    jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
        method: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            if (data[0] == 'ok') {
                button.parentElement.style.color = "red"
                button.parentNode.parentNode.remove();
                // button.parentNode.innerHTML = 'بایگانی شد'
                removeArchivedRow(trClassName);
            } else {
                button.parentElement.style.color = "blue"
                button.parentNode.innerHTML = 'خطا در عملیات'
            }
        },
        error: function(xhr) {
            console.log('error', xhr);
            button.parentNode.innerHTML = 'خطا در اینترنت'
        }
    })
}
/**
 * functionality for toggle rows by clicking
 */
function toggleRowInfos(element, event) {
    if (element.classList.contains('activeTr')) {
        element.classList.remove('activeTr')
    } else {
        element.classList.add('activeTr')
    }
    let className = '.' + element.id.toString();
    let trs = document.querySelectorAll(className)
    for (let i = 0; i < trs.length; i++) {
        if (trs[i].classList.contains('none')) {
            trs[i].classList.remove('none')
            trs[i].classList.add('display')
        } else if (trs[i].classList.contains('display')) {
            trs[i].classList.remove('display')
            trs[i].classList.add('none')
        } else {
            trs[i].classList.add('none')
        }
    }
}

//remove rows that archived by click
function removeArchivedRow(className) {
    let tds = document.querySelectorAll(className.toString())
    for (let i = 0; i < tds.length; i++) {
        tds[i].remove();
    }
}

//change or set one order_product to accept
function acceptOneOrder(user_id, button, event, order_product_id) {
    let idNumber = button.getAttribute("data-orderid").replace(/\D/g, '');
    let tdsClassName = '.status' + idNumber;
    var data = {
            user_id: user_id,
            order_id: button.getAttribute("data-orderid"),
            order_product_id: order_product_id,
            typeAction: "acceptOne"
        }
        // sent ajax request
    jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
        method: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            if (data[0] == 'owned') {
                button.parentElement.style.color = "green"
                button.parentNode.innerHTML = 'انجام شده'
            } else if (data[0].response == 'ok') {
                //fire function accept all
                let btnAcceptAll = document.querySelector("#success" + button.getAttribute("data-orderid"))
                    //send sms to customer
                if (data[0].customerSessonId == null) {
                    //user is offline
                    removeAlert(false, 'کاربر مورد نظر شما انلاین نیست');
                } else {
                    //user is online
                    let copyData = {};
                    let q = 0
                    for (q = 0; q < data[0].storeSessionId.length; q++) {
                        copyData.customerSessonId = data[0].customerSessonId;
                        copyData.storeSessionId = data[0].storeSessionId[q].session_id
                        smsentSmsToCustomers([copyData]);
                    }
                }
                //end fire function accept all
                button.parentElement.style.color = "green"
                button.parentNode.innerHTML = 'انجام شده'
                let btn = document.querySelector('#statusField' + button.getAttribute("data-orderid"));
                btn.innerHTML = 'انجام شد'
            } else if (data[0] == 'other') {
                removeAlert(false, null);
                button.parentElement.style.color = 'red'
                button.parentNode.innerHTML = 'بلاک شده'
            } else { //e.g notok status error update
                button.parentElement.style.color = "blue"
                button.parentNode.innerHTML = 'خطا در عملیات'
                notificationDisplay(tdsClassName, 'خطا در عملیات', 'blue', 'white')
            }
        },
        error: function(xhr) {
            console.log('error', xhr);
            button.parentNode.innerHTML = 'خطا در اینترنت'
                // notificationDisplay(tdsClassName,'خطا در اینترنت','red','white')
        }
    })
}

/**
 * remove alert notification
 */
function removeAlert(isClicked = false, text = null) {
    let textElement = document.querySelector('#alertText');
    if (text != null) {
        textElement.innerHTML = text.toString()
    } else {
        textElement.innerHTML = 'سفارش مورد نظر شما قبلا توسط فروشگاه دیگر پذیرفته شده است.';
    }
    let element = document.querySelector('.close-alert');
    element = element.parentElement;
    if (isClicked) {
        element.classList.remove('display')
        element.classList.add('none')
    } else {
        if (element.classList.contains('display') == false) {
            element.classList.add('display')
            element.classList.remove('none')
        }
    }
}

/**
 * click on alert for show same category products in table
 */
var myDataTable = null

function clickModal(user_id, order_id, product_id, order_product_id) {
    // let idNumber = button.getAttribute("data-orderid").replace(/\D/g, '');
    oldRowData.baseProduct_id = product_id;
    oldRowData.order_id = order_id;
    oldRowData.order_product_id = order_product_id;
    oldRowData.user_id = user_id;
    var data = {
        product_id: product_id,
        typeAction: "getSameCategory"
    }
    console.log(data)
        // sent ajax request
    jQuery.ajax({
            url: "http://hypertester.ir/serverHypernetShowUnion/showProductReplacement.php",
            method: "POST",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                console.log(data)
                if (data[0].response == 'ok') {
                    jQuery("#modalData tbody").children().remove()
                    data[0].data.forEach((row, index) => {
                        jQuery("#modalData").append(`<tr class="btn btn-block" onclick="clickrow(this,${row.product_id})">
                <th scope="row">${index}</th>
                <td ondblclick="changeTd(this,${row.product_id},'name')">${row.product_name}</td>
                <td ondblclick="changeTd(this,${row.product_id},'price')">${parseFloat(row.product_price_percentage).toFixed(2)}</td>
                <td ondblclick="changeTd(this,${row.product_id},'count')">${row.product_quantity}</td>
                <td id = "td${row.product_id}"  class = "display-inherit btn-group"role = "group"aria - label = "Basic example" ><button class="btn btn-sm btn-primary saved" onclick="rowSaveData(this,${row.product_id})">
                <i class="fas fa-check"></i>
                </button>
                <button class="btn btn-sm btn-danger reject reject${row.product_id}" onclick="rejectRowChange(this,${row.product_id})">
                <i class="fas fa-times">
                </i>
                </button></td>
                </tr>`)
                    });


                    if (jQuery('.dataTables_length').hasClass('bs-select')) {
                        jQuery('.dataTables_length').removeClass('bs-select')
                    }
                    if (myDataTable != null) {
                        dataTable
                        myDataTable.destroy();

                    }
                    /** dataTable scripts */
                    jQuery(document).ready(function() {
                        myDataTable = jQuery('#modalData').DataTable({
                            "scrollY": "200px",
                            "scrollCollapse": true,
                        });
                        myDataTable
                        new $.fn.dataTable.Responsive(myDataTable);
                        jQuery('.dataTables_length').addClass('bs-select');
                    });
                    /**end dataTable scripts */


                } else { //e.g notok status error update

                    jQuery("#modalData tbody").children().remove()
                    jQuery("#modalData").append(`<tr><td  colspan="4" class="h4 text-danger" >خطا در گرفتن اطلاعات.</td></tr>`);


                    setTimeout(() => {
                        jQuery('#myModal').modal('hide');
                    }, 10000);

                }
            },
            error: function(xhr) {
                console.log('error', xhr);
                alert('خطا در اینترنت')
                    // notificationDisplay(tdsClassName,'خطا در اینترنت','red','white')
            }
        })
        // clear all data
    jQuery("#modalData tbody").children().remove()
        // add spinner untill data will fetched
    jQuery("#modalData").append(`<tr><td  colspan="4" class="h2" ><i class="fas fa-spinner fa-spin"></i></td></tr>
        <tr><td  colspan="4" class="h4" >در حال نمایش محصولات</td></tr>`);
    // show alert 
    jQuery('#myModal').modal('show');
}


var oldRowData = { tdChanged: false, buttonAppended: false };
var newRowData = { tdChanged: false, dataAppended: false };

/**click function for rows in modal */
function clickrow(tr, product_id) {
    if (oldRowData.tdChanged == false) {
        console.log('inside hi')
        let childs = jQuery(tr).children().length
        for (let y = 0; y < childs; y++) {
            if (y == 1) {
                oldRowData.name = jQuery(jQuery(tr).children()[y]).text()
            } else if (y == 2) {
                oldRowData.price = jQuery(jQuery(tr).children()[y]).text()
            } else if (y == 3) {
                oldRowData.count = jQuery(jQuery(tr).children()[y]).text()
            } else {}
        }


        oldRowData.product_id = product_id;
    }

}


/** change one files row in modal */
function changeTd(td, product_id, typeField) {
    // show td that is hide
    clickrow(td.parentElement, product_id);
    oldRowData.tdChanged = true;
    if (oldRowData.product_id == product_id) {

        let tr = jQuery(td).parent();
        td.parentNode.style.background = "blue"
        td.parentNode.style.color = "white"

        //add input to field
        if (typeField == 'name') {
            td.innerHTML = `<input type="text" id="name" class="inputLarge" name="name" value="${oldRowData.name}">`
        } else if (typeField == 'count') {
            td.innerHTML = `<input type="number" id="count" class="inputSmall" name="count" value="${parseInt(oldRowData.count)}">`
        } else {
            td.innerHTML = `<input type="number" id="price" class="inputMedium"  name="price" step="0.01" value="${parseFloat(oldRowData.price).toFixed(2)}">`
        }
    }

}

// reject change product
function rejectRowChange(button, product_id) {
    button.parentElement.parentElement.style.background = 'white'
    button.parentElement.parentElement.style.color = 'black'
    let tr = jQuery(jQuery(button).parent()).parent();
    let childs = jQuery(tr).children().length
    for (let y = 0; y < childs; y++) {
        if (y == 0) {
            //
        } else if (y == 1) {
            jQuery(jQuery(tr).children()[y]).html(oldRowData.name)
        } else if (y == 2) {
            jQuery(jQuery(tr).children()[y]).html(oldRowData.price)
        } else if (y == 3) {
            jQuery(jQuery(tr).children()[y]).html(oldRowData.count)
        } else if (y == 4) {

        } else {
            //
        }
    }
    oldRowData = Object.assign({}, {})
    oldRowData.tdChanged = false;
}

//save message
function rowSaveData(button, product_id) {
    //get nput value three input
    let name = document.querySelector('#name')
    let nameValue = name ? name.value : null;
    let count = document.querySelector('#count');
    let countValue = count ? count.value : null;
    let price = document.querySelector('#price');
    let priceValue = price ? price.value : null;

    console.log('inputs')
    console.log(name, count, price)
    functionName(
        functionCount(
            functionPrice({ name, count, price, nameValue, priceValue, countValue }),
            functionPrice({ name, count, price, nameValue, priceValue, countValue })
        ),
        functionCount(
            functionPrice({ name, count, price, nameValue, priceValue, countValue }),
            functionPrice({ name, count, price, nameValue, priceValue, countValue })
        )

    );
    // close modal
    jQuery('#myModal').modal('hide');

    //old data
    // console.log(oldRowData)

    // transfer important data between old data and new data
    newRowData.product_id = oldRowData.product_id;
    newRowData.baseProduct_id = oldRowData.baseProduct_id
    newRowData.order_product_id = oldRowData.order_product_id
    newRowData.order_id = oldRowData.order_id
    newRowData.user_id = oldRowData.user_id


    //post data to webservice
    saveDatabaseReplaceProduct(newRowData);

    //save in dom
    saveDom(newRowData)

    //call function reject
    let btnReject = document.querySelector('.reject' + newRowData.product_id)
    rejectRowChange(btnReject, newRowData.product_id)

}

//function price
function functionName(nullAction = null, fullAction = null) {
    let dataObject = nullAction ? nullAction : fullAction;
    if (dataObject.name == null) {
        //name is null
        newRowData.name = oldRowData.name
    } else {
        //name is not null
        newRowData.name = dataObject.nameValue
    }
}

//function count
function functionCount(nullAction = null, fullAction = null) {
    let dataObject = nullAction ? nullAction : fullAction;
    if (dataObject.count == null) {
        //cout is null
        newRowData.count = oldRowData.count
    } else {
        //count is not null
        newRowData.count = dataObject.countValue
    }
    return dataObject;
}
//function price
function functionPrice(dataObject) {
    if (dataObject.price == null) {
        //price is null
        newRowData.price = oldRowData.price
    } else {
        //price is not null
        newRowData.price = dataObject.priceValue
    }
    return dataObject;
}


//save into dom
function saveDom(newRowData) {
    //create new row for replce product
    let newRowProduct = `
            <tr class="order${newRowData.order_id} baseProductId${newRowData.product_id} transition display">
                <th scope="row">${newRowData.order_id}</th>
                <td id="name${newRowData.product_id}">${newRowData.name}</td>
                <td id="count${newRowData.product_id}">${newRowData.count}</td>
                <td id="price${newRowData.product_id}">${newRowData.price}</td>
                <td style="color:red" class="status${newRowData.order_id}">              
                    <button class="btn btn-default" onclick="acceptOneOrder(${newRowData.user_id},this,event,${newRowData.order_product_id})" style="background:green;color:white;" data-orderid="${newRowData.order_id}">قبول</button>
                    <!-- <button class="btn btn-default" onclick="rejectOrder(${newRowData.user_id},this,event)" style="background:red;color:white;" data-orderId="${newRowData.order_id}">رد</button> -->
                    <!-- Trigger the modal with a button -->
                    <!-- <button type="button" class="btn btn-warning btn" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
                    <button type="button" class="btn btn-warning btn" onclick="clickModal(${newRowData.user_id},${newRowData.order_id},${newRowData.product_id},${newRowData.order_product_id})">تغییر محصول</button>
                </td>
            </tr> `;

    let tr = document.querySelector(`.baseProductId${newRowData.product_id}`)

    jQuery(tr).after(newRowProduct);
    jQuery(tr).remove();
}

//save into database
function saveDatabaseReplaceProduct(newRowData) {
    let data = {
        "product_id": newRowData.product_id,
        "count": newRowData.count,
        "price": newRowData.price,
        "name": newRowData.name,
        "order_id": newRowData.order_id,
        "user_id": newRowData.user_id,
        "typeAction": "saveOneProposal"
    };
    jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
        method: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            console.log(data)
            if (data[0].response == 'ok') {

            } else { //e.g notok status error insert

            }
        },
        error: function(xhr) {
            console.log('error', xhr);
            alert('خطا در اینترنت')
                // notificationDisplay(tdsClassName,'خطا در اینترنت','red','white')
        }
    })
}