var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
var pieChart       = new Chart(pieChartCanvas)

var PieData        = [
    {
    value    : 18,
    color    : '#0F9D58',
    highlight: '#0f9d29',
    label    : 'Positif'
    },
    {
    value    : 1,
    color    : '#DB4437',
    highlight: '#db3a00',
    label    : 'Negatif'
    },
    {
    value    : 81,
    color    : '#a9a9a6',
    highlight: '#bbbbbb',
    label    : 'Netral'
    }
]
var pieOptions     = {
    segmentShowStroke    : true,
    segmentStrokeColor   : '#fff',
    segmentStrokeWidth   : 1,
    percentageInnerCutout: 0, // This is 0 for Pie charts
    animationSteps       : 100,
    animationEasing      : 'easeOutBounce',
    animateRotate        : true,
    animateScale         : false,
    responsive           : true,
    maintainAspectRatio  : true,
    //String - A legend template
    legendTemplate       : '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span class=\"indicator_box\" style=\"padding:1px 10px;border-radius: 50%;background-color:<%=segments[i].fillColor%>\"></span><span><%if(segments[i].label){%><%=segments[i].label%><%}%></span></li><%}%></ul>'
}

pieChart.Doughnut(PieData, pieOptions)

function chartNolimit(e) {
	var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
	var pieChart       = new Chart(pieChartCanvas)
	
	var PieData        = [
		{
		value    : e[0],
		color    : '#0F9D58',
		highlight: '#0f9d29',
		label    : 'Positif'
		},
		{
		value    : e[1],
		color    : '#DB4437',
		highlight: '#db3a00',
		label    : 'Negatif'
		},
		{
		value    : e[2],
		color    : '#a9a9a6',
        highlight: '#bbbbbb',
		label    : 'Netral'
		}
	]
	var pieOptions     = {
		segmentShowStroke    : true,
		segmentStrokeColor   : '#fff',
		segmentStrokeWidth   : 1,
		percentageInnerCutout: 0, // This is 0 for Pie charts
		animationSteps       : 100,
		animationEasing      : 'easeOutBounce',
		animateRotate        : true,
		animateScale         : false,
		responsive           : true,
		maintainAspectRatio  : true,
		//String - A legend template
		legendTemplate       : '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span class=\"indicator_box\" style=\"padding:1px 10px;border-radius: 50%;background-color:<%=segments[i].fillColor%>\"></span><span><%if(segments[i].label){%><%=segments[i].label%><%}%></span></li><%}%></ul>'
	}
	
	pieChart.Doughnut(PieData, pieOptions)
}

$('.btn-nolimit').click(function(){
	var id = $(this).data('id');
    
	switch (id) {
        case 1:
            dataNolimit = [18,1,81];
            topik = 'Hubungan Internasional'
            next = 2;
            prev = 17;

            break;
        case 2:
            dataNolimit = [3,5,92];
            topik = 'Pertahanan dan Keamanan';
            next = 3;
            prev = 1;

            break;
        case 3:
            dataNolimit = [27,7,66];
            topik = 'Informasi dan Layanan Publik';
            next = 4;
            prev = 2;

            break;
        case 4:
            dataNolimit = [22,1,77];
            topik = 'Tata Kelola Pemerintahan';
            next = 5;
            prev = 3;

            break;
        case 5:
            dataNolimit = [1,3,96];
            topik = 'Kebijakan Afirmatif';
            next = 6;
            prev = 4;

            break;
        case 6:
            dataNolimit = [2,11,87];
            topik = 'Buruh Migran';
            next = 7;
            prev = 5;

            break;
        case 7:
            dataNolimit = [1,3,96];
            topik = 'Penegakan Hukum';
            next = 8;
            prev = 6;

            break;
        case 8:
            dataNolimit = [4,0,96];
            topik = 'Pertanian dan Reforma Agraria';
            next = 9;
            prev = 7;

            break;
        case 9:
            dataNolimit = [9,43,48];
            topik = 'Energi';
            next = 10;
            prev = 8;

            break;
        case 10:
            dataNolimit = [0,15,85];
            topik = 'Ketenagakerjaan';
            next = 11;
            prev = 9;

            break;
        case 11:
            dataNolimit = [7,10,83];
            topik = 'Investasi';
            next = 12;
            prev = 10;

            break;
        case 12:
            dataNolimit = [7,1,92];
            topik = 'Infrastruktur';
            next = 13;
            prev = 11;

            break;
        case 13:
            dataNolimit = [17,2,81];
            topik = 'Maritim';
            next = 14;
            prev = 12;

            break;
        case 14:
            dataNolimit = [1,5,94];
            topik = 'Pemerataan Pembangunan';
            next = 15;
            prev = 13;

            break;
        case 15:
            dataNolimit = [7,0,93];
            topik = 'Pariwisata';
            next = 16;
            prev = 14;

            break;
        case 16:
            dataNolimit = [4,1,95];
            topik = 'Perdagangan';
            next = 17;
            prev = 15;

            break;
        default:
            dataNolimit = [3,2,95];
            topik = 'Pendidikan dan Kebudayaan';
            next = 1;
            prev = 16;

            break;
    }
    $('#chart-title').html(topik);
    $('#button-next').data('id',next);
    $('#button-prev').data('id',prev);
    $('#chart-body').html('<canvas id="pieChart"></canvas>');

    chartNolimit(dataNolimit);
});