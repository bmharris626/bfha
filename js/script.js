(function(global){

  var bfha = new Object();

  // Function called by the Last Name input field
  LastNameQuery = function(request, response) {
    Autocomplete("lastName", request, response);
  }
  // Function called by the First Name input field
  FirstNameQuery = function(request, response) {
    Autocomplete("firstName", request, response);
  }

  function Autocomplete(type, request, response) {
    // Call to autocomplete.php to retrieve first 5 distinct matching results
    var jqxhr = $.post("php/autocomplete.php", {
      last_name: $("#last-name").val() + "%",
      first_name: $("#first-name").val() + "%",
      collection: $("#collection").val(),
      column: type
    }, "json");
    // Function to populate display list on page to show results
    jqxhr.done(function(results){ response(JSON.parse(results)); });
  }

  bfha.LastName = $("#last-name").autocomplete({source: LastNameQuery, delay: 30});
  bfha.FirstName = $("#first-name").autocomplete({source: FirstNameQuery, delay: 30});

  global.$bfha = bfha;

})(window);
