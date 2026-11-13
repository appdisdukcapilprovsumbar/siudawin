<?php

namespace App\Libraries;

$adjacents = 2;
/* Setup page vars for display. */
if (isset($_GET["page"])) {
	$page = $_GET["page"];
} else {
	$page = 1;
}
$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_records / $records_per_page);		//lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;						//last page minus 1
/*
			Now we apply our rules and draw the mypager object.
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
$mypager = "";
if ($lastpage > 1) {
	$mypager .= "<ul class='pagination justify-content-end'>";
	//previous button
	if ($page > 1)
		$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=$prev'><i class='fa fa-chevron-left'></i></a></li>";
	else
		$mypager .= "<li class='page-item disabled'><a class='page-link'><i class='fa fa-chevron-left'></i></a></li>";

	//pages
	if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
	{
		for ($counter = 1; $counter <= $lastpage; $counter++) {
			if ($counter == $page)
				$mypager .= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
			else
				$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=$counter'>$counter</a></li>";
		}
	} elseif ($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
	{
		//close to beginning; only hide later pages
		if ($page < 1 + ($adjacents * 2)) {
			for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
				if ($counter == $page)
					$mypager .= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
				else
					$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=$counter'>$counter</a></li>";
			}
			$mypager .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
			$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=$lpm1'>$lpm1</a></li>";
			$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=$lastpage'>$lastpage</a></li>";
		}
		//in middle; hide some front and some back
		elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
			$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=1'>1</a></li>";
			$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=2'>2</a></li>";
			$mypager .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
				if ($counter == $page)
					$mypager .= "<li class='page-item active'><a class='page-link'>$counter</a></li>";
				else
					$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=$counter'>$counter</a></li>";
			}
			$mypager .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
			$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=$lpm1'>$lpm1</a></li>";
			$mypager .= "<li class='page-item'><a href='$pageLink&page=$lastpage'>$lastpage</a></li>";
		}
		//close to end; only hide early pages
		else {
			$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=1'>1</a></li>";
			$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=2'>2</a></li>";
			$mypager .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
				if ($counter == $page)
					$mypager .= "<li class='page-item'><a class='page-link'>$counter</a></li>";
				else
					$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=$counter'>$counter</a></li>";
			}
		}
	}

	//next button
	if ($page < $counter - 1)
		$mypager .= "<li class='page-item'><a class='page-link' href='$pageLink&page=$next'><i class='fa fa-chevron-right'></i></a></li>";
	else
		$mypager .= "<li class='page-item disabled'><a class='page-link'><i class='fa fa-chevron-right'></i></a></li>";
	$mypager .= "</ul>\n";
}

echo $mypager;
