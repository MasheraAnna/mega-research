var rootHeight = $('#root').height();

var data = $.getJSON('index.php', function (data) {

	// создадим разметку и сохраним ее в переменную:
	function StartPage(props){
		return (
		<div className = 'page'> 
			<div className = 'header'>
				Это хедер
			</div>
			<div className = "content">
				<div className = "helloText">
					{props.qText}
				</div>
				<div className = "helloButtons">
					<button className = "arrow-btn">
						<i className = "fa fa-chevron-left fa-2x move_left"></i>
					</button>
					<button className = "arrow-btn">
						<i className = "fa fa-chevron-right fa-2x move_right"></i>
					</button>
					<div className = "pressEnterText">
						нажмите ENTER
					</div>
				</div>
			</div>
			<div className = 'footer'>
				Это футер
			</div>
		</div>
		);
	};

	ReactDOM.render(<StartPage qText = {data['question']['qText']}/>, document.getElementById("root"));
});