<?php 
include 'includes/header.html';
?>
<script type="text/javascript" src="scripts/analysis.js"></script>
<style type="text/css">
  .result-table-div{
    width: 70%;
    margin: auto;
  }
  .result-table{
    table-layout: fixed;
    text-align: center;
  }

  #header-div{
    width: 70%;
    margin: auto;
    text-align: center;
  }

  .loader {
    border: 5px solid #f3f3f3; /* Light grey */
    border-top: 5px solid #a1a1a1; /* Blue */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
    margin: auto;
  }

  #print{
    margin-left: 75%;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>

<div id="header-div">
  <h1>K. J. Somaiya College of Engineering</h1>
  <h2>Semester 1 Result Analysis</h2>
</div>
<div id="printpdf">
<div class="result-table-div">
  <div class="loader"></div>
  <table class="table table-bordered result-table" id="total">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Male</th>
        <th scope="col">Female</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Number of Students passed Semester 1 without KT</th>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="result-table-div">
  
  <table class="table table-bordered result-table" id="total-rv">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Male</th>
        <th scope="col">Female</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Number of Students passed Semester 1 Before reassesment / reverification without KT</th>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="result-table-div">
  
  <table class="table table-bordered result-table" id="minority">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Male</th>
        <th scope="col">Female</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Number of Minority Students passed Semester 1 without KT</th>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="result-table-div">
  
  <table class="table table-bordered result-table"rv id="minority-">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Male</th>
        <th scope="col">Female</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Number of Minority Students passed Semester 1 Before reassesment / reverification without KT</th>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="result-table-div">
  
  <table class="table table-bordered result-table" id="kt">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Male</th>
        <th scope="col">Female</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Number of Students passed with one course KT</th>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">Number of Students passed with two course KT</th>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">Number of Students passed with three course KT</th>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">Number of Students passed with four course KT</th>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="result-table-div">
  
  <table class="table table-bordered result-table" id="grade-point">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Male</th>
        <th scope="col">Female</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Number of Students passed with grade point 10</th>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">Number of Students passed with grade point 9-10</th>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">Number of Students passed with grade point 8-9</th>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">Number of Students passed with grade point 7-8</th>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">Number of Students passed with grade point 6-7</th>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">Number of Students passed with grade point 5-6</th>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>
</div>

<button id="print" type="button" class="btn btn-primary" onclick="printpdf()">Export as PDF</button>


<?php 
include 'includes/footer.php';
?>