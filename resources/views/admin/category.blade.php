
<!DOCTYPE html>
<html lang="en">
  <head>
   {{-- css file --}}
   @include('admin.css')
   {{-- css file --}}
   <style>
    @media(max-width:700px){
        #category-form{
            width: 100% !important;
        }
    }

    table tr:nth-child(even){
        background: #30263a;
    }
    table tr:nth-child(odd){
        background: #1b1523
    }
    table thead tr{
        background: rgb(61, 53, 92) !important; 
        color: white !important;
    }
   </style>
    </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
       @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                <div class="text-center text-capitalize alert alert-success">
                    {{session()->get('message')}}
                </div>
                @elseif(session()->has('delete'))
                 <div class="text-center text-capitalize alert alert-danger">
                    {{session()->get('delete')}}
                </div>
                @endif
                <h2 class="text-center my-5">Add category</h2>
                <form id="category-form" class="w-50" action="{{route('add_category')}}" method="post">
                    @csrf
                   <div class="form-group">
                    <label for="" class="form-label">Category Name:</label>
                    <input type="text" placeholder="Enter category name" name="category_name" class="form-control text-light" required>
                   </div>
                  
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary">Add</button>
                  </div>
                </form>
                <h3 class="text-light my-2 mb-4"> All Categories:</h3>
                <table class="table">
                    <thead>
                        
                    <tr class="tr text-danger">
                        <th class="text-light">Category name</th>
                        <th class="text-light">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $data)
                        <tr class="tr">
                            <td>{{$data->category_name}}</td>
                            <td>
                                <button class="btn btn-success">edit</button>
                               <a href="{{route('delete_category')}}?id={{$data->id}}"> <button class="btn btn-danger">delete</button></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    
                </table>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
   {{-- js file --}}
   @include('admin.script')
   {{-- js file --}}


    <script>
        const alertElement = document.querySelector('.alert');
        const Element = document.querySelector('.content-wrapper');
        if(alertElement){
       setTimeout(() => {
         alertElement.remove();
       }, 4000);}
    </script>
  </body>
</html>