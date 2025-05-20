// import React from 'react';

// function Ten(){
// 	return (
// 		<div>
// 			<h1>This is my Ten Jsx file</h1>
// 			<p>This is my Ten Component file</p>
// 		</div>
// 		);
// }

// export default Ten;

import React from 'react';

function Ten(props){
	return (
		<div>
			<h1>This is my Ten Jsx file {props.value}</h1>
			<p>This is my Ten Component file</p>
		</div>
		);
}

export default Ten;