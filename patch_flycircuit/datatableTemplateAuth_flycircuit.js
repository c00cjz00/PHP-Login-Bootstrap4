(function($){
var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {	
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
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
		order: [[ 2, 'asc' ]],		
        columns: [
           { 
				data: "id", 
				className: 'dt-center select-checkbox',
				orderable: false,
				searchable: false,				
				render: function(data,type,row,meta){
					var uuid = row['neuron'];  
					var link = '';
					return data ?
					link :null	
				}
            },	
            { 
				data: "id", 
				className: 'dt-center',
				orderable: false,
				searchable: false,				
				render: function(data,type,row,meta){
					var imagingTechnique = row['imagingTechnique'];  
                    if ( imagingTechnique == 'Confocal' ) {
						var uuid = row['neuron'];  						
						var link = '<a href=\"fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.LSM.crop.png\" target=\"_blank\"><img src=\"fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.LSM.small.png\" height=\"45"></a>\
						<a href=\"displayImg.php?img=fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.neuron.png\" target=\"_blank\"><img src=\"fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.neuron.small.png\"  height=\"45\"></a>\
						<a href=\"displayImg.php?img=fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.lineset.RP2n.png\" target=\"_blank\"><img src=\"fc2Images/NeuronData_v1.3/'+ uuid +'/'+ uuid +'.lineset.RP2n.small.png\"  height=\"45\"></a>';
                    } else {
						var uuid = row['bridgeID02'];  
						var neuPrint = row['bridgeID03'];  
						var link = '<a href=\"fc2Images/FlyEM/images/LSM/'+ uuid +'-E-'+ neuPrint +'/'+ uuid +'-E-'+ neuPrint +'_LSM_1.png\" target=\"_blank\"><img src=\"fc2Images/FlyEM/images/LSM/'+ uuid +'-E-'+ neuPrint +'/'+ uuid +'-E-'+ neuPrint +'_LSM_1s.png\" height=\"45"></a>\
						<a href=\"fc2Images/FlyEM/images/neuron/'+ uuid +'-E-'+ neuPrint +'/'+ uuid +'-E-'+ neuPrint +'_Neuron_1.png\" target=\"_blank\"><img src=\"fc2Images/FlyEM/images/neuron/'+ uuid +'-E-'+ neuPrint +'/'+ uuid +'-E-'+ neuPrint +'_Neuron_1s.png\" height=\"45"></a>\
						<a href=\"fc2Images/FlyEM/images/skeleton/'+ uuid +'-E-'+ neuPrint +'/'+ uuid +'-E-'+ neuPrint +'_Lineset_1.png\" target=\"_blank\"><img src=\"fc2Images/FlyEM/images/skeleton/'+ uuid +'-E-'+ neuPrint +'/'+ uuid +'-E-'+ neuPrint +'_Lineset_1s.png\" height=\"45"></a>';
					}
					return data ?
					link :null	
				}
            }, 				
            { data: "neuron", className: 'dt-center' },
            { data: "neuronName", className: 'dt-center' },
            { data: "gender",  className: 'dt-center' },
            { data: "age",  className: 'dt-center'  },
            { data: "driver",  className: 'dt-center'  },
            { data: "neurotransmitter",  className: 'dt-center'  },
            { data: "birthtiming",  className: 'dt-center'  },
            { data: "class",  className: 'dt-center'  },
            { data: "type",  className: 'dt-center'  },
            { data: "imagingTechnique",  className: 'dt-center'  },
            { data: "library",  className: 'dt-center'  },
            { data: "reference",  className: 'dt-center'  }
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
