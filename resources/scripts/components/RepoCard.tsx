import React, { FC } from 'react'
import { Repository } from '../@types/models'
import star from './../assets/icon-star.svg'
import fork from './../assets/icon-fork.svg'

interface RepoCardProps {
  showDetails: (repo: Repository) => void
  repo: Repository
}

const RepoCard: FC<RepoCardProps> = (props) => (
  <div className="col-12 col-sm-6 col-lg-4">
    <div className="card border border-pop mb-3" onClick={() => props.showDetails(props.repo)}>
      <div className="card-body">
        <img src={props.repo.avatar} className="figure-fluid rounded float-left mt-2" style={{ maxHeight: '4em' }} alt="Repository avatar" />
        <div className="text-left" style={{ marginLeft: '5em' }}>
          <h4 className="card-subtitle text-truncate">
            <small>by {props.repo.owner}</small>
          </h4>
          <h3 className="card-title text-truncate">
            {props.repo.name}
          </h3>
          <div className="d-inline">
            <img src={star} alt="Icon for stars count" aria-hidden="true" />
            {props.repo.stars}
          </div>
          <div className="d-inline ml-3">
            <img src={fork} alt="Icon for forks count" aria-hidden="true" />
            {props.repo.forks}
          </div>
        </div>
      </div>
    </div>
  </div>
)

export default RepoCard
