<?php
$style = <<<Demo

    
.btn:focus,
.btn:active:focus {
  outline: thin dotted;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.btn:hover,
.btn:focus {
  color: #333;
  text-decoration: none;
}
.btn:active {
  background-image: none;
  outline: 0;
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
}
/* default
---------------------------- */
.btn-default {
  color: #333;
  background-color: #fff;
  border-color: lightblue;
}
.btn-default:focus {
  color: #333;
  background-color: silver;
  border-color: #8c8c8c;
}
.btn-default:hover {
  color: #333;
  background-color: sandybrown;
  border-color: #adadad;
}
.btn-default:active {
  color: #333;
  background-color: silver;
  border-color: lightseagreen;
}
/* mystyles for beautify webpage */
caption {
  caption-side: top;
  margin: auto;
  text-align: center;
  background-color: aquamarine;
  color: black;
  font-weight: bold;
  font-size: .1.2rem;
}
.btn-warning {
  background-color: orange;
  color: maroon;
}
.btn-dange {
  background-color: red;
  color: white;
}
.btn-success {
  background-color: green;
  color: white;
}
.btn-danger {
  background-color: red;
  color: white;
}
table thead tr {
  background-color: #81A7E3 !important;
  color: black;
}
table tbody tr.transition {
  background-color: #4682B4;
  color: white;
}
.activeTr {
  background-color: darkturquoise;
}
/* styles for toggle rows */
.none {
  opacity: 0;
  display: none;
}
.display {
  opacity: 1 display:block;
}
.w-100 {
  width: 100% !important;
}
.orderHeader {
  font-size: 14px;
  padding: 4px 10px;
  margin-bottom: 0;
  text-decoration: none;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 8px;
}
.table {
  font-size: 1.4rem !important;
}
/* styles for alert */
.text-center {
  text-align: center;
}
.close-alert {
  position: absolute !important;
  right: 5px;
  display: inline;
  top: 6px;
}
.blue {
  color: blue;
}
body {
  text-align: center !important;
}
.modal-backdrop.show {
  display: relative !important;
  opacity: 1 !important;
}
#myModal {
  margin-top: 80px;
}
.modal-body table tr {
  display: table-row;
}
table#storeOrders tbody tr:hover {     background-color: teal !important;color:white; }
table#modalData tbody tr:hover {     background-color: teal !important;color:white; }


/* add style for dataTable */
  table.dataTable thead .sorting:after,
  table.dataTable thead .sorting:before,
  table.dataTable thead .sorting_asc:after,
  table.dataTable thead .sorting_asc:before,
  table.dataTable thead .sorting_asc_disabled:after,
  table.dataTable thead .sorting_asc_disabled:before,
  table.dataTable thead .sorting_desc:after,
  table.dataTable thead .sorting_desc:before,
  table.dataTable thead .sorting_desc_disabled:after,
  table.dataTable thead .sorting_desc_disabled:before {
      bottom: .5em;
  }
/**end style for dataTable */
Demo;
echo $style;
?>