import React, { Component } from 'react'
import Repo from './Repo'
import Modal from './Modal'
import api from './../services/ApiConsumer'
import loading from './../assets/loading.gif'

class DisplayPanel extends Component {

  state = {
    isLoading: false,
    repositories: [],
    visibleDetails: false,
    detailsFor: {}
  }

  componentDidMount() {
    this.setState({
      isLoading: true,
      repositories: []
    })
    this.displayContent()
    api.getRepositories(1) // FIXME: Make request dynamic
      .then(response => this.setState({ repositories: response.data }))
      .catch(response => console.log(response))
      .finally(this.setState({ isLoading: false }))
  }

  displayContent = () => {
    if (this.state.isLoading) {
      return (
        <div id="panel-loading-{{ $language->id }}" className="content text-center">
          <img src={loading} alt="Loading animation" />
        </div>
      )
    }
    return (
      <div className="row">
        {
          this.state.repositories.map((repo, index) => {
            return (
              <Repo
                key={index}
                repo={repo}
                showDetails={this.toggleDetails}
              />
            )
          })
        }
      </div>
    )
  }

  toggleDetails = (repo = {}) => {
    this.setState({
      visibleDetails: !!repo,
      detailsFor: repo
    })
  }

  getDetails = () => {
    if (this.state.visibleDetails) {
      return <Modal repo={this.state.detailsFor} hideDetails={this.toggleDetails} />
    }
  }

  render() {
    return (
      <div className="content">
        {this.displayContent()}
        {this.getDetails()}
      </div>
    )
  }
}

export default DisplayPanel
