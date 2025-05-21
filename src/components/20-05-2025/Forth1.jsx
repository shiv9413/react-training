import React from 'react';

// const Forth1 = ({name}) => <h1>This is forthe advanced method {name}</h1>;
// export default Forth1;

const Card = ({children}) => {
	return <div className="card">{children}</div>;
}

export default Card;