function GetDetail(id){
            if (id.length == 0) {
                document.getElementById("order_id").value = "";
                document.getElementById("order_status").value = "";
                return;
            }
            else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && 
                           this.status == 200) {
                                var myObj = JSON.parse(this.responseText);
                                document.getElementById
                                ("order_id").value = myObj[0];
                                document.getElementById
                                ("order_status").value = myObj[1];
                            }
                };
                    xmlhttp.open("GET", "functions/update_orders_ajax.php?order_id=" + id, true);
                    xmlhttp.send();
            }
}