import React, {Component} from 'react';
import ReactDOM from 'react-dom';

class ReactIndex extends Component {
    render() {
        return (
            <div>
                Test react class
            </div>
        );
    }
}

ReactDOM.render(<ReactIndex/>, document.getElementById("root"));