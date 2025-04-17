<?php
get_header();
?>
<div class="about-wraper">
<div class="container" id="home-content">
<div class="breadcrumb">
<li> About-us </li>
<li class="active"> Board of Directors </li>
</div>
<h3><strong>BOARD OF DIRECTORS</strong></h3>
<table style="margin-left: 100px;">
  <tr>
    <td>
      Paul Tam
    </td>
    <td>
      Chairman
    </td>
  </tr>
  <tr>
    <td>
      Allen Chan
    </td>
    <td>
      Vice - Chairman
    </td>
  </tr>
  <tr>
    <td>
      Bernard Loh
    </td>
    <td>
      Communication Director
    </td>
  </tr>
  <tr>
    <td>
      Wilson Miao
    </td>
    <td>
      Public Relations Director
    </td>
  </tr>
  <tr>
    <td>
      Phillip Ng
    </td>
    <td>
      Assistant to the Chair
    </td>
  </tr>
  <tr>
    <td>
      Richie Wong
    </td>
    <td>
      Legal Advisor
    </td>
  </tr>
  <tr>
    <td>
      Simon Tso
    </td>
    <td>
      Financial Advisor
    </td>
  </tr>
  <tr>
    <td>
      Florence Gordon
    </td>
    <td>
      Senior Advisor
    </td>
  </tr>

</table>
<!--
<div id="myModal1" class="modal">

Modal content
  <div class="modal-content">
    <div class="modal-body">
	<div class="row">
	<div class="col-sm-7" id="modal-photo">
	</div>
	<div class="col-sm-5" id ="modal-detail">
	<span class="close" id="span1">&times;</span>
	<div class="detail-wraper">
	<h4 class="dir-name">PAUL TAM</h4><br>

	</div>
	</div>
    </div>
    </div>
  </div>

</div>
<div class="col-sm-3" style="padding: 15px;">
  <div id="profile-col">
  <div class="profile-name">ALLEN CHAN</div>
<a href="#" class="bio" id="myBtn2" onclick='GetId(this);'><u>VIEW-BIO</u></a>
</div>
</div>

<!-- The Modal
<div id="myModal2" class="modal" >

  <!-- Modal content
  <div class="modal-content">
    <div class="modal-body">
	<div class="row">
	<div class="col-sm-7" id="modal-photo">
	</div>
	<div class="col-sm-5" id ="modal-detail">
	<span class="close" id="span2">&times;</span>
	<div class="detail-wraper">
	<h4 class="dir-name">ALLEN CHAN</h4><br>
	<strong>INTELLI PROPERTY DEVELOPMENT INC. </strong>
	<p>2016 - Present<br>
	Managing Director </p> <br>
	<strong>CHISLON DEVELOPMENT CORP.</strong>
	<p>2014 - Present<br>
	Managing Director</p>
	</div>
	</div>
    </div>
    </div>
  </div>

</div>
<div class="col-sm-3" style="padding: 15px;">
  <div id="profile-col">
  <div class="profile-name">BERNARD LOH</div>
<a href="#" class="bio"  id="myBtn3" onclick='GetId(this);'><u>VIEW-BIO</u></a>
</div>
</div>
<!-- The Modal
<div id="myModal3" class="modal">

  <!-- Modal content
  <div class="modal-content">
    <div class="modal-body">
	<div class="row">
	<div class="col-sm-7" id="modal-photo">
	</div>
	<div class="col-sm-5" id ="modal-detail">
	<span class="close" id="span3">&times;</span>
	<div class="detail-wraper">

	</div>
	</div>
    </div>
    </div>
  </div>

</div>
<div class="col-sm-3" style="padding: 15px;">
<div id="profile-col">
<div class="profile-name">PHILLIP NG</div>
<a href="#"  class="bio" id="myBtn4" onclick='GetId(this);'><u>VIEW-BIO</u></a>
</div>
</div>
<!-- The Modal
<div id="myModal4" class="modal">

  <!-- Modal content
  <div class="modal-content">
    <div class="modal-body">
	<div class="row">
	<div class="col-sm-7" id="modal-photo">
	</div>
	<div class="col-sm-5" id ="modal-detail">
	<span class="close" id="span4">&times;</span>
	<div class="detail-wraper">

	</div>
	</div>
    </div>
    </div>
  </div>

</div>
</div>
<div class="row" >
<div class="col-sm-3" style="padding: 15px;">
<div id="profile-col">
<div class="profile-name">WILSON MIAO</div>
<a href="#" class="bio" id="myBtn5" onclick='GetId(this);'><u>VIEW-BIO</u></a>
</div>
</div>
<!-- The Modal
<div id="myModal5" class="modal">

  <!-- Modal content
  <div class="modal-content">
    <div class="modal-body">
	<div class="row">
	<div class="col-sm-7" id="modal-photo">
	</div>
	<div class="col-sm-5" id ="modal-detail">
	<span class="close" id="span5">&times;</span>
	<div class="detail-wraper">

	</div>
	</div>
    </div>
    </div>
  </div>

</div>-->
</div>
</div>
<script>


 function GetId(obj)
    {
	var currentId = document.getElementById(obj.id).id;
	var numb = currentId.match(/\d+$/)[0];
	var temp="myModal".concat(numb);
	window.modal = document.getElementById(temp);
    modal.style.display = "block";
	// When the user clicks on <span> (x), close the modal
	var clo = "span".concat(numb);
	window.span = document.getElementById(clo);

	span.onclick = function() {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}

}


</script>
<?php
get_footer();
?>
