import React from 'react';

//const Second = ({chance}) => <h1>This is second chance ,{chance}</h1>
//export default Second;

const Card = ({children}) => {
	return <div class="card">{children}</div>;
}

export default Card;