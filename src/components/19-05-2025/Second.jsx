// import React from 'react';

// function Second(){
// 	return (
// 		<div>
// 			<h1>This is my Second Jsx file</h1>
// 			<p>This is my Second Component</p>
// 		</div>
// 		);
// }

// export default Second;

import React from 'react';

function Second(props){
	return (
		<h1>Second Name , {props.name}</h1>
		);
}

export default Second;