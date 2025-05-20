// import React from 'react';

// function First(){
// 	return (
// 		<div>
// 			<h1>This is my first jsx file</h1>
// 			<p>This is my first component of react</p>
// 		</div>
// 		);
// }

// export default First;

import React from 'react';

function First(props){
	return (
		<h1>Hello, {props.name}</h1>
		)
}

export default First;
