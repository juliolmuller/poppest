import React, { Component } from 'react'
import PropTypes from 'prop-types'
import api from './../services/ApiConsumer'
import loading from './../assets/loading.gif'

class ControlPanel extends Component {

  state = {
    languages: [],
    isRefreshing: false
  }

  componentDidMount() {
    api.getLanguages()
      .then(response => this.setState({ languages: response.data }))
      .catch(response => console.log(response))
  }

  getRefreshmentStyles = () => {
    if (this.state.isRefreshing) {
      return {
        background: `url(${loading})`,
        backgroundPosition: 'center',
        backgroundSize: 'cover',
        color: 'rgb(0, 0, 0, 0)',
        overflow: 'hidden'
      }
    }
  }

  refreshResources = () => {
    this.setState({ isRefreshing: true })
    api.refreshDatabase()
      .catch(response => console.log(response))
      .finally(() => {
        this.props.activateTab(this.props.activeLang)
        this.setState({ isRefreshing: false })
      })
  }

  render() {
    return (
      <React.Fragment>
        <div className="row">
          <div className="col-12 col-sm-10">
            <h2 className="content-header">
              Pick your favorite language:
            </h2>
          </div>
          <div className="col-12 col-sm-2">
            <button
              type="button"
              className="btn btn-lg btn-outline-pop btn-block"
              style={this.getRefreshmentStyles()}
              disabled={this.state.isRefreshing}
              onClick={this.refreshResources}
            >Refresh</button>
          </div>
        </div>
        <div className="row">
          <div className="progress col-sm-12">
            <div className="progress-bar progress-bar-striped progress-bar-animated bg-pop" role="progressbar" style={{ width: '100%' }} aria-valuemax="100"></div>
          </div>
        </div>
        <nav className="nav nav-pills nav-fill">
          {
            this.state.languages.map(lang => {
              return (
                <button
                  key={lang.id}
                  type="button"
                  id={`activate-lang-${lang.id}`}
                  className={`btn btn-outline-pop nav-item ${this.props.activeLang === lang.id ? 'active' : ''}`}
                  disabled={this.state.isRefreshing}
                  onClick={this.props.activateTab.bind(this, lang.id)}
                >{lang.name}</button>
              )
            })
          }
        </nav>
      </React.Fragment>
    )
  }
}

ControlPanel.propTypes = {
  activeLang: PropTypes.number,
  activateTab: PropTypes.func.isRequired
}

export default ControlPanel
