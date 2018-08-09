var Invoice = {
  symbol: '€',
  init: function(){
    Invoice.update();
    Invoice.uiEvent();
  },
  uiEvent: function(){
    
    $('#items').on('click','.delete', function(e){
      e.preventDefault();
      $(this).parent().parent().remove();
      Invoice.update();
    });
    
    $('#items').on('change','.price,.quantity,.tax_rate', function(e){
      Invoice.update();
    });
    
    $('#addItemButton').on('click', function(e){
      e.preventDefault();
      Invoice.addItem();
      Invoice.update();
    });
  },
  update: function(){
    var subtotal=0,
        taxable=0,
        taxs={},
        total=0;
    
    $('#items tr').each(function(){
      //$(this).css('background','red');
      
      var price = parseFloat($('.price',this).val());
      var qta = parseInt($('.quantity',this).val());
      var tax_rate = parseInt($('.tax_rate option:selected',this).val());
      
      var total_price = price*qta;
      subtotal += total_price;
      
      if(tax_rate>0){
        var tax = (total_price*tax_rate)/100;
        
        var tax_rate_item = taxs[tax_rate] || 0;
        taxs[tax_rate] = tax_rate_item + tax;
        taxable += tax;
      }
      $('.price',this).val(parseFloat(price).toFixed(2));
      $('.total-price',this).html('€ ' + parseFloat(total_price).toFixed(2));
    });
    
    $('#invoiceSubtotal').html('€ ' + parseFloat(subtotal).toFixed(2));
    
    $('#invoiceTax').html('€ ' + parseFloat(taxable).toFixed(2));
    
    total = parseFloat(subtotal)+parseFloat(taxable);
    $('#invoiceTotal').html('€ ' + parseFloat(total).toFixed(2));
    
    //$('#taxs').hide();
    $('#taxs tbody tr').remove();
    
    $.each(taxs, function(index, value) {
      var parse_value = parseFloat(value).toFixed(2)
      $('#taxs tbody').append('<tr><th>'+index+'%</th><td>€ '+parse_value+'</td></tr>');
    });
    Invoice.displayTaxs();
    Invoice.displayDelete();
  },
  addItem: function(){
    alert();
    var html = '<tr id="item-1"><td ></td><td><select class="form-control select2" id="selectCustomer" required="required" name="customer_id" class="form-control"><option disabled selected value> -- select an option -- </option>@foreach ($customers as $customer)<option @if(old('customer_id')==$customer->id || (isset($payment->customer_id) && $payment->customer_id==$customer->id )){{'selected="selected"'}}@endif value="{{$customer->id}}">{{$customer->name}}</option>@endforeach</select></td><td><input type="number" class="quantity" name="quantity" step="1" value="3"></td><td><input disabled="disabled" type="number" class="stock" step="1" value="3"></td><td><input type="number" class="price" name="price" step="0.01" value="10.00"></td><td class="total-price">€ 0,00</td><td><a href="#" class="delete">x</a></td></tr>';
    $('#items').append(html);
  },
  displayDelete: function(){
    var deleteCnt = $('.delete').length;
    if(deleteCnt > 1){
      $('.delete').show();
    }else{
      $('.delete').hide();
    }
  },
  displayTaxs: function(){
    var taxsCnt = $('#taxs tbody tr').length;
    if(taxsCnt > 0){
       $('.tax-container').show();
    }else{
      $('.tax-container').hide();
    }
  }
};
$(document).ready(function(){

	// launc
	Invoice.init();
})