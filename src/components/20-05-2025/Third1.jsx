import React from 'react';

// const Third = ({name}) => <h1>THis is third chance,{name} </h1>;
// export default Third;

const Card = ({children}) => {
	return <div className="card">{children}</div>;
}

export default Card;