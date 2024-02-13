<!DOCTYPE html>
<html>
  <head>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      body {
        font-family: Arial;
      }

      /* Style the tab */
      .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
      }

      /* Style the buttons inside the tab */
      .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
      }

      /* Change background color of buttons on hover */
      .tab button:hover {
        background-color: #ddd;
      }

      /* Create an active/current tablink class */
      .tab button.active {
        background-color: #ccc;
      }

      /* Style the tab content */
      .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
      }
    </style>
  </head>
  <body>
    @csrf

    <div class="tab">
      <button class="tablinks" onclick="openCity(event, 'page_shopify')">
        Pages
      </button>
      <button class="tablinks" onclick="openCity(event, 'logs_shopify')">
        Logs
      </button>
    </div>

    <div id="page_shopify" class="tabcontent">
      <form action="{{url('/createpage' )}}" method="post">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label"
            >Title</label
          >
          <input
            type="text"
            class="form-control"
            id="exampleInputEmail1"
            name="title"
            aria-describedby="emailHelp"
          />
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Body</label>
          <input
            type="text"
            class="form-control"
            id="exampleInputPassword1"
            name="body"
          />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    <div id="logs_shopify" class="tabcontent">
      <button type="button" onclick="loadDoc()">Change Content</button>
      <div id="demo"></div>
    </div>

    <script>
      function loadDoc() {
        var elements = document.getElementsByName("_token");
        var token = elements[0];
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
          document.getElementById("demo").innerHTML = this.responseText;
        };
        xhttp.open(
          "POST",
          "https://princetestone.bloomxapi.in/getPageList?_token=" + token.value
        );
        xhttp.send();
      }
    </script>

    <script>
      function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
      }
    </script>
  </body>
</html>
