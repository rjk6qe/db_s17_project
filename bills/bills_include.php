<script type="text/javascript">
  function send_request(){
    $.get('../bills/bills_ajax.php', {'query' : $("#search").val(), 'order_column': $("#search_select").val()}, function(data){
        var response = JSON.parse(data);
        $("#search_result").html(response['html']);
        $("#result_length").text(response['length']);
        console.log("loading");
        $("tr[name='data_row']").each(function(){
          $(this).on('click', function(){
            $("#inputbillid").val($(this).children().first().text());
            $("#inputbillid").trigger('input');
          });
        });
      });
  }

  $(document).ready(function(){
    send_request();
    $("#search").on('input', function(){
      send_request();      
    });
    $("#search_select").on('input', function(){
      send_request();
    });
  });
</script>

<div id="search_param_div">
<label>Attribute to Search</label>
  <select class="form-control" id="search_select">
    <option value="title">Title</option>
    <option value="bill_id">Bill ID</option>
    <option value="committee_id">Committee ID</option>
  </select>
<label>Search Text</label>
  <input type="text" class="form-control" id="search">
  <br>
</div>

<label>Number of Results</label>
  <label id="result_length"></label>

<div id="search_result" class="table-responsive">