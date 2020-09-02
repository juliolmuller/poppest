import React from 'react'
import star from './../assets/icon-star.svg'
import fork from './../assets/icon-fork.svg'

interface RepoProps {
  showDetails: (repo: Repository) => void
  repo: Repository
}

const Repo: React.FC<RepoProps> = ({ showDetails, repo }) => (
  <div className="col-12 col-sm-6 col-lg-4">
    <div className="card border border-pop mb-3" onClick={() => showDetails(repo)}>
      <div className="card-body">
        <img src={repo.avatar} className="figure-fluid rounded float-left mt-2" style={{ maxHeight: '4em' }} alt="Repository avatar" />
        <div className="text-left" style={{ marginLeft: '5em' }}>
          <h4 className="card-subtitle text-truncate">
            <small>by {repo.owner}</small>
          </h4>
          <h3 className="card-title text-truncate">
            {repo.name}
          </h3>
          <div className="d-inline">
            <img src={star} alt="Icon for stars count" aria-hidden="true" />
            {repo.stars}
          </div>
          <div className="d-inline ml-3">
            <img src={fork} alt="Icon for forks count" aria-hidden="true" />
            {repo.forks}
          </div>
        </div>
      </div>
    </div>
  </div>
)

export default Repo
