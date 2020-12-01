<?php
$user = JFactory::getUser();
$usid = $user->get('id');
$db = JFactory::getDbo();

// show company
$sql = "SELECT pish_phocamaps_marker_company.*\n"

    . "FROM pish_phocamaps_marker_company  \n"

    . "WHERE marketer_user_id = $usid";
$db->setQuery($sql);
$markets = $db->loadAssocList();

  echo "<table class='table table-bordered table-striped table-hover'><tbody><tr><th>نام شرکت/فروشگاه</th><th>شماره تماس</th><th>نوع</th><th>  میزان سفارشات این ماه</th><th>حاشیه سود سفارشات</th><th>پورسانت هایپربوک</th><th>سهم پورسانت شما</th></tr>";
  $idx = 0; 
  foreach ($markets as $row) {
$type = "شرکت";

$trnsctn=550000;
$mrgns=0.1*550000;
$hprbkprsnt=0.5*$mrgns;
$spsnprsnt=0.25*$hprbkprsnt;
echo "<tr class='$cls'><td>".$row['ShopName']."</td><td>".$row['phone']."</td><td>".$type."</td><td>".$trnsctn."</td><td>".$mrgns."</td><td>".$hprbkprsnt."</td><td>".$spsnprsnt."</td></tr>";
    $idx++;
}
  echo "</tbody></table>";



  // show stores
  $sql = "SELECT pish_phocamaps_marker_store.*\n"

    . "FROM pish_phocamaps_marker_store  \n"

    . "WHERE marketer_user_id = $usid";
$db->setQuery($sql);
$markets = $db->loadAssocList();

  echo "<table class='table table-bordered table-striped table-hover'><tbody><tr><th>نام شرکت/فروشگاه</th><th>شماره تماس</th><th>نوع</th><th>  میزان سفارشات این ماه</th><th>حاشیه سود سفارشات</th><th>پورسانت هایپربوک</th><th>سهم پورسانت شما</th></tr>";
  $idx = 0; 
  foreach ($markets as $row) {
$type = "فروشگاه";
$trnsctn=550000;
$mrgns=0.1*550000;
$hprbkprsnt=0.5*$mrgns;
$spsnprsnt=0.25*$hprbkprsnt;
echo "<tr class='$cls'><td>".$row['ShopName']."</td><td>".$row['phone']."</td><td>".$type."</td><td>".$trnsctn."</td><td>".$mrgns."</td><td>".$hprbkprsnt."</td><td>".$spsnprsnt."</td></tr>";
    $idx++;
}
  echo "</tbody></table>";
  
?>