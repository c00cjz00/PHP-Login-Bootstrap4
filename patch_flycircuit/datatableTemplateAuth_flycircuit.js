(function($){
var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {	
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );	
	var selected = [];
	var table =  $('#example').DataTable( {
		processing: true,		
        serverSide: true,
		scrollX: true,
		lengthMenu: [ [10, 25, 50, 1000], [10, 25, 50, 1000] ],
        ajax: {
            url: "datatableTemplateAuth_flycircuit_staff.php?mytable="+mytable,
            type: "POST"
        },
        rowCallback: function( row, data ) {
            if ( $.inArray(data.neuron, selected) !== -1 ) {
                $(row).addClass('selected');
            }

        },		
        columns: [
            { 
				data: "id", 
				className: 'dt-center select-checkbox',
				orderable: false,
				render: function(data,type,row,meta){
					var uuid = row['neuron'];  
					var link = '';
					return data ?
					link :null	
				}
            },	
            /*{ 
				data: "id", 
				className: 'dt-center',
					orderable: false,
				render: function ( data, type, row, meta ) {
					var uuid = row['neuron'];  
					var link = '<!--a target=\"_blank\" href=\"videos.php?neuronName='+ uuid +'\" class=\"btn btn-info btn-xs mycustombutton\" role=\"button\">LSM</a-->\
					<a href=\"downloads.php?neuronName='+ uuid +'&neuronType=nii.gz\" class=\"btn btn-warning btn-xs mycustombutton\" role=\"button\">NIFTI</a>\
					<a href=\"downloads.php?neuronName='+ uuid +'&neuronType=swc\" class=\"btn btn-primary btn-xs mycustombutton\" role=\"button\">SWC</a>\
					<!--a target="_blank" href=\"plugins/swcViewer/swc.php?neuronID='+ uuid +'\" class=\"btn btn-success btn-xs mycustombutton\" role=\"button\"><i class="fa fa-eye" aria-hidden="true"></i></a-->\
					<a target=\"_blank\" href=\"neuronID.php?=&neuronid='+ uuid +'\" class=\"btn btn-danger btn-xs mycustombutton\" role=\"button\">ID</a>';
					return data ?
					link :null
				}				
            },*/
            { 
				data: "lsm", 
				className: 'dt-center',
				orderable: false,
				render: function(data,type,row,meta){
					var uuid = row['neuron'];  
					var link = '<a href=\"fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.LSM.crop.png\" target=\"_blank\"><img src=\"fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.LSM.small.png\" width=\"45"></a>\
					<a href=\"displayImg.php?img=fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.neuron.png\" target=\"_blank\"><img src=\"fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.neuron.small.png\"  width=\"45\"></a>\
					<a href=\"displayImg.php?img=fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.lineset.RP2n.png\" target=\"_blank\"><img src=\"fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.lineset.RP2n.small.png\"  width=\"45\"></a>';
					/*<a href=\"displayImg.php?img=fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.neuron.png\" data-toggle=\"modal\" data-target=\"#myModal\"><img src=\"fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.neuron.small.png\"  width=\"84\"></a>';
					<iframe src=\"plugins/swcViewer/swc.php?neuronID='+ uuid +'\" style=\"width: 50%; height: 50%\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\" frameborder=\"0\" vspace=\"0\" hspace=\"0\"></iframe>';	
					<a href="SummaryDetailSQL.php?sid='+link+'" data-toggle="modal" class="btn btn-info"  data-target="#myModal">'+link+'</a>\*/

					return data ?
					link :null	
				}
            },					
            { data: "neuron", className: 'dt-center' },
            { data: "gender",  className: 'dt-center' },
            { data: "age",  className: 'dt-center'  },
            { data: "driver",  className: 'dt-center'  },
            { data: "neurotransmitter",  className: 'dt-center'  },
            { data: "birthtiming",  className: 'dt-center'  },
            { data: "neuronVolume",  className: 'dt-center'  },
            { data: "author",  className: 'dt-center'  }
        ],
		initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }		
	} );
    $('#example tbody').on('click', 'tr', function () {
        //var id = this.id;
        var id = table.row( this ).data().neuron;
		var index = $.inArray(id, selected);
        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }
 
        $(this).toggleClass('selected');
		document.getElementById("mySelected").value = selected;

    } );
 	/*  $('#example tbody').on('click', 'tr', function () {
        //var id = this.id;
        var id = table.row( this ).data().neuron;
		var index = $.inArray(id, selected);
		
			var item = $(this).closest("tr")   // Finds the closest row <tr> 
						   .find(".neuron")     // Gets a descendent with class="nr"
						   .text();      		
						   
		var cell=$(this).closest('td');
		 var col = $(this).closest('td').data('col');
		//console.log($(this).children(2).text());		
		console.log( 'You clicked on '+ cell.index() + '123' + col+'\'s cell' );
						   
		//console.log($(this).children(2).text());		
		console.log( 'You clicked on '+ item + '123' + item+'\'s cell' );
        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }
 
        $(this).toggleClass('selected');
		document.getElementById("mySelected").value = selected;

    } );


    $('#example tbody').on('click', 'td', function () {
       var data = table.cell( this ).data();
	   var rowIdx = table.cell( this ).index().row;
	   var colIdx = table.cell( this ).index().column;
	   //var columnData = table.column( $(this).index();
       //console.log( 'You clicked on '+ rowIdx + '123' + data+'\'s cell' );
	   if ( colIdx === 2 ) {
       var id = table.row( this ).data().neuron;
	   var index = $.inArray(id, selected);
 
       if ( index === -1 ) {
            selected.push( id );
       } else {
           selected.splice( index, 1 );
       }
 
       $(this).toggleClass('selected');
	   document.getElementById("mySelected").value = selected;
	   }
    } );*/

	$('#button_selectall').click( function () {
		table.rows(  ).select(); 
		var rowData = table.rows( '.selected' ).data().toArray();
		rowData.forEach(function(item){
			var id = item["neuron"];
			//console.log(neuron);
			var index = $.inArray(id, selected);
			if ( index === -1 ) {
				selected.push( id );
			} else {
				//selected.splice( index, 1 );
			}
			$(this).toggleClass('selected');
			document.getElementById("mySelected").value = selected;
		
		});
	});

	$('#button_removeall').click( function () {
		table.rows(  ).select(); 
		var rowData = table.rows( '.selected' ).data().toArray();
		rowData.forEach(function(item){
			var id = item["neuron"];
			//console.log(neuron);
			var index = $.inArray(id, selected);
			if ( index === -1 ) {
				//selected.push( id );
			} else {
				selected.splice( index, 1 );
			}
			table.rows(  ).deselect(); 
			$(this).toggleClass('selected');
			document.getElementById("mySelected").value = selected;
		});
	});
} );

$(document).ready(function(){
    // Show the Modal on load
    //$("#myModal").modal("show");
    // Hide the Modal
    $("#myModal").click(function(){
       // $("#myModal").modal("hide");
		$(document.body).bind('hidden.bs.modal', function () {
		  $('#myModal').removeData('bs.modal')
		});
    });
});
}(jQuery));
