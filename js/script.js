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
      column: type
    }, "json");
    // Function to populate display list on page to show results
    jqxhr.done(function(results) {
      results = JSON.parse(results);
      if (typeof(results) == "object") { response(results) }
      else {console.log("ERROR: PHP could not connect to database.")}
    });
  }

  bfha.LastName = $("#last-name").autocomplete({source: LastNameQuery, delay: 10});
  bfha.FirstName = $("#first-name").autocomplete({source: FirstNameQuery, delay: 10});

  bfha.Query = function() {
    // Call to query.php to retrieve results from the bfha database
    var jqxhr = $.post("php/query.php", {
      last_name: $("#last-name").val(),
      first_name: $("#last-name").val(),
      collection: $("#collection").val() + "%"
    }, "json");
    // Function to populate the results on the page
    jqxhr.done(function(results) {
      console.log(results);
    });
  }

  global.$bfha = bfha;

})(window);
