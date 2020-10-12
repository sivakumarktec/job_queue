@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="margin-top: 12px;" >Customer List</h2><br>

    <div class="row">
        <div class="col-12">
          <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-customer">Add Customer</a> 
          <table class="table table-bordered data-table">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th width="280px">Action</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
          </table>
       </div> 
       @include('add-edit-modal')
    </div>
</div>
 
<script>

  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*  When customer click add customer button */
    $('#create-new-customer').click(function () {
        $('#btn-save').val("create-customer");
        $('#customerForm').trigger("reset");
        $('#customerCrudModal').html("Add New Customer");
        $('#ajax-customer-modal').modal('show');
    });
 
   /* When click edit customer */
    $('body').on('click', '.editCustomer', function () {
      var customer_id = $(this).data('id');
      $.get("{{ url('customer')}}" + "/" + customer_id + "/edit", function (data) {
         $('#customerCrudModal').html("Edit Customer");
          $('#btn-save').val("edit-customer");
          $('#ajax-customer-modal').modal('show');
          $('#customer_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
      })
   });
   //delete customer login
    $('body').on('click', '.deleteCustomer', function () {
        var customer_id = $(this).data("id");
        if(confirm("Are You sure want to delete !")) {
 
        $.ajax({
            type: "DELETE",
            url: "{{ url('customer')}}"+'/'+customer_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
       }
    });   
  });
 
  var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('customer/customerList') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]

    });

  if ($("#customerForm").length > 0) {
      $("#customerForm").validate({
 
     submitHandler: function(form) {
 
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
      
      $.ajax({
          data: $('#customerForm').serialize(),
          url: "{{ route('customer.store')}}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

 
              $('#customerForm').trigger("reset");
              $('#ajax-customer-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              table.draw();
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
   
  
</script>
@endsection
