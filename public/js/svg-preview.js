var stage = new Kinetic.Stage({
    container: 'preview-container',
    width: 1024,
    height: 768
});

var layer = new Kinetic.Layer({
    scale: 0.6
});

var figure = new Kinetic.Path();

function drawLineData(node, color){
    node.setStroke(color);
    node.setStrokeWidth(3);
    node.opacity(.8);
    layer.draw();
}

function readURL(input) {
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        	
			$('#image_figure').val(e.target.result);
            
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('#preview-button').on('click', function(){
	var image_input = document.getElementById('txt-imagepng1');
	var svg_points  = $('.svg-control').val();
	var image_figure = $('#image_figure').val();
	console.log(svg_points);
	//readURL(image_input);
	$('#feature_preview').attr('src', image_figure);
	
	figure.data(svg_points);
	drawLineData(figure, 'blue');
	layer.draw();        
	layer.add(figure);
	
	stage.add(layer);
});

$("#txt-imagepng1").change(function(){
	readURL(this);
    $('#preview-button').removeAttr('disabled');
});

figure.on('click', function() { alert('Todo ha salido bien!'); });